<?php
session_start(); // Make sure to start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['worker_id']) && isset($_POST['worker_email']) && isset($_SESSION['email'])) {
        $request_id = $_POST['worker_id'];
        $worker_email = $_POST['worker_email'];
        $client_email = $_SESSION['email'];
        
        // Assuming you have a database connection established
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "urban-workers1";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Assuming you have a table named hire_requests with columns: request_id, worker_email, client_email, and status
        $status = "pending";
        $insertSql = "INSERT INTO hire_request (request_id, client_email, worker_email, status) 
                      VALUES ('$request_id', '$client_email', '$worker_email', '$status')";
   
        if ($conn->query($insertSql) === TRUE) {
            echo "<script>alert('work request successfully'); window.location.href = '../index1.php';</script>";
        } else {
            echo $conn->error; // Return the error message
        }
        
        $conn->close();
    } else {
        echo "Invalid data received.";
    }
} else {
    echo "Invalid request method.";
}
?>
