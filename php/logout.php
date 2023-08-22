<?php
session_start();
session_destroy(); // Destroy the session
header("Location: ../index1.php"); // Redirect to main page
exit();
?>
