<?php
session_start(); // Make sure to start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['service_name'])) {
        $service_name = $_POST['service_name'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "urban-workers1";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $insertSql = "INSERT INTO addnewservices (service_name) VALUES (?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("s", $service_name); // "s" indicates a string parameter
       
        if ($stmt->execute()) {
            echo "<script>alert('add service successfully'); window.location.href = '../admin.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid data received.";
    }
} else {
    echo "Invalid request method.";
}
?>