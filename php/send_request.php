<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ID = $_GET['ID'];
    $email = $_GET['email'];
    $send_request=$_GET['send_request'];
    

    
    // You can perform additional validation and sanitation on ID and email if needed
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "urban-workers";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the database update to indicate that a request has been sent
    $sql = "UPDATE signupworkers SET send_request = $send_request+1 WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo "Request sent successfully.";
    } else {
        echo "Error sending request: " . $conn->error;
    }

    $conn->close();
}
?>
