<?php
 if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ID = $_GET['ID'];
    $email = $_GET['email'];
    $ratings = $_GET['ratings'];

    // Perform necessary validation and sanitation on $ratings and $email
    // Remember to validate user input and use prepared statements to prevent SQL injection

    // Replace with your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "urban-workers";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the rating in the database
    $sql = "UPDATE signupworkers SET ratings = (select avg($ratings) from signupworkers) WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo "Rating updated successfully.";
    } else {
        echo "Error updating rating: " . $conn->error;
    }

    $conn->close();
}

?>
