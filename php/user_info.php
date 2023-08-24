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

    // Handle the submitted rating if applicable
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['worker']) && isset($_POST['rating'])) {
        $workerEmail = $_POST['worker'];
        $rating = $_POST['rating'];

        // Perform database update query to save the rating in hire_request
        $ratingQuery = "UPDATE hire_request SET rating = $rating WHERE worker_email = '$workerEmail' and client_email='$userEmail'";
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

    // Display the table of hire requests and buttons to give ratings
    echo "<table>
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
            echo "<a href='?worker={$row['worker_email']}'>Give Rating</a>";
        }
        echo "</td></tr>";
    }
    echo "</table>";

    // Display the rating form if applicable
    if (isset($_GET['worker'])) {
        $workerEmail = $_GET['worker'];
        echo "<form action='' method='post'>
                <label for='rating'>Rating:</label>
                <input type='number' name='rating' min='1' max='5' required>
                <input type='hidden' name='worker' value='$workerEmail'>
                <input type='submit' value='Submit Rating'>
              </form>";
    }
} else {
    header("Location: index.html");
    exit();
}

mysqli_close($connection); // Close the database connection
?>
