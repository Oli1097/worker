<?php
session_start();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $host = "localhost";
    $dbname = "urban-workers";
    $dbpass = "";
    $dbuname = "root";

    $conn = new mysqli($host, $dbuname, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM signupworkers WHERE email='$email' AND pass='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["email"] = $email;
        header("Location: ../index1.php"); // Redirect to main page
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
