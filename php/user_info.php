<?php
// Start the session
session_start();

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "urban-workers1";
$connection = new mysqli($servername, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Fetch hire requests for the current user from the database
    $query = "SELECT worker_email, status FROM hire_request WHERE client_email = '$userEmail'";
    $result = mysqli_query($connection, $query);

    // Handle the submitted rating and review if applicable
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['worker']) && isset($_POST['rating']) && isset($_POST['review'])) {
        $workerEmail = $_POST['worker'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];

        // Perform database update query to save the rating and review in hire_request
        $ratingQuery = "UPDATE hire_request SET rating = $rating, review = '$review' WHERE worker_email = '$workerEmail' AND client_email = '$userEmail'";
        $ratingResult = mysqli_query($connection, $ratingQuery);

        // Calculate the average rating for the worker from hire_request table
        $averageRatingQuery = "SELECT AVG(rating) AS avg_rating FROM hire_request WHERE worker_email = '$workerEmail'";
        $averageRatingResult = mysqli_query($connection, $averageRatingQuery);
        $averageRatingRow = mysqli_fetch_assoc($averageRatingResult);
        $averageRating = $averageRatingRow['avg_rating'];

        // Perform database update query to update average rating in signupworkers table
        $updateAvgRatingQuery = "UPDATE signupworkers SET ratings = $averageRating WHERE email = '$workerEmail'";
        mysqli_query($connection, $updateAvgRatingQuery);
    }


    // Display the table of hire requests and buttons to give ratings and reviews
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
            a {
                color: blue;
                text-decoration: none;
            }
            .rating {
                margin-top: 20px;
                padding: 10px;
                border: 1px solid #ddd;
                background-color: #f9f9f9;
            }
            .rating label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .rating input[type='number'],
            .rating input[type='text'] {
                width: 100%;
                // padding: 8px;
                padding-top: 20px;
                padding-bottom: 20px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .rating input[type='submit'] {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px 15px;
                border-radius: 4px;
                cursor: pointer;
            }
            .rating input[type='submit']:hover {
                background-color: #0056b3;
            }
            .num{
                // padding: 10px 15px;

            }
        </style>
        <title>Hire Requests and Ratings</title>
    </head>
    <body>


        <div class='container'>



            <table>
                <tr>
                    <th>Worker Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                    
                </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['worker_email']}</td>
                <td>{$row['status']}</td>
                <td>";
        if ($row['status'] == 'approved') {
            echo "<a href='?worker={$row['worker_email']}'>Give Rating and Review</a>";
        }
        echo "</td>
                <td></td>
            </tr>";
    }
    echo "</table>";
    if (isset($_GET['worker'])) {
        $workerEmail = $_GET['worker'];
        echo "<form action='' method='post' class='rating'>
        
        <label for='rating'>Rating (1 to 5) : </label>
        <input class='num' type='number' name='rating'placeholder='Please enter a rating between 1 and 5.' min='1' max='5' required>
        
        
                
                <label for='review'>Review:</label>
                <input type='text' name='review' required>
                <input type='hidden' name='worker' value='$workerEmail'>
                <input type='submit' value='Submit Rating and Review'>

                
              </form>";
    }
    echo "</div></body></html>";
} else {
    header("Location: index.html");
    exit();
}

mysqli_close($connection); // Close the database connection
?>
