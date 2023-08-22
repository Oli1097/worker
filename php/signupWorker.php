<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $contact = $_POST["contact"];
    $services = $_POST["services"];
    $pass = $_POST["pass"];
    $confirm = $_POST["confirm"];
    
    // Process and validate other form fields here
    
    // Handling the uploaded image
    // Handling the uploaded image
if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
    $picture = $_FILES["picture"];
    $ext = pathinfo($picture["name"], PATHINFO_EXTENSION);
    $pictureFileName = uniqid() . "." . $ext;
    $uploadDirectory = "uploads/";
    
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $uploadPath = $uploadDirectory . $pictureFileName;
    move_uploaded_file($picture["tmp_name"], $uploadPath);
} else {
    // Handle case where no image is uploaded
    $uploadPath = "uploads/default.png"; // Set a default image path
}

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "urban-workers";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO signupworkers (full_name, email, address, city, contact, services, pass, confirm, picture)
            VALUES ('$full_name', '$email', '$address', '$city', '$contact', '$services', '$pass', '$confirm', '$uploadPath')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../signUpWorker.html"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 