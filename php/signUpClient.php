<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $contact = $_POST["contact"];
    $pass = $_POST["pass"];
    $confirm = $_POST["confirm"];
    
    // Process and validate other form fields here
    
    // Handling the uploaded image
    // Handling the uploaded image

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "urban-workers";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO signupclient (full_name, email, address, city, contact, pass, confirm)
            VALUES ('$full_name', '$email', '$address', '$city', '$contact',  '$pass', '$confirm')";
    
    if ($conn->query($sql) === TRUE) {
        $fetch_query = "SELECT ID FROM signupclient WHERE email='$email'";
        $result = $conn->query($fetch_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fetched_id = $row["ID"];
            header("Location: ../index1.php");
        } else {
            echo "No ID found.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!-- Rest of your HTML code -->
