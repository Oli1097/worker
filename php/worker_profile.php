<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}


// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "urban-workers1";
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle availability settings
    if (isset($_POST['approve']) || isset($_POST['reject'])) {
        $availabilityStatus = isset($_POST['approve']) ? 'available' : 'unavailable';
        $email = $_POST['email'];

        // Update worker availability in the database
        $updateAvailabilitySql = "UPDATE signupworkers SET availability = '$availabilityStatus' WHERE email = '$email'";
        if ($connection->query($updateAvailabilitySql) === TRUE) {
            echo "<script>alert('avaiability status updated'); window.location.href = 'worker_profile.php';</script>";
        } else {
            echo "Error updating availability: " . $connection->error;
        }
    }

    // Handle request approval/rejection
    if (isset($_POST['approve_request']) || isset($_POST['reject_request'])) {
        $email = $_POST['email'];
        $worker_email = $_POST['worker_email'];
        $client_email = $_POST['client_email'];
        $requestStatus = isset($_POST['approve_request']) ? 'approved' : 'rejected';

        // Update request status in the hire_request table
        $updateRequestSql = "UPDATE hire_request SET status = '$requestStatus' WHERE worker_email = '$worker_email' AND client_email = '$client_email'";
        if ($connection->query($updateRequestSql) === TRUE) {
            echo "Request status updated successfully.";
        } else {
            echo "Error updating request status: " . $connection->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
    <title>Workers Information</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .header {
            color: black;
            font-weight: 600;
            font-size: 30px;
            text-align: center;
            margin-top: 20px;
        }

        .success-message {
            text-align: center;
            color: green;
            padding: 10px;

        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: #f6f9f2;
            padding: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            width: calc(20% - 20px);
            margin: 10px;
            display: flex;
            align-items: center;
            background-color: #dbc7c2;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding-bottom: 20px;
        }

        .card img {
            max-width: 300px;
            height: 200px;
            border-radius: 10%;
        }

        .card-info {
            flex: 1;
        }

        .card-info h2 {
            margin: 0;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .card-info p {
            margin: 0;
            font-size: 14px;
            color: black;
            padding-top: 10px;
            font-weight: 600;
        }

        .button-form {
            text-align: center;
            margin-top: 10px;

        }

        .btn-available,
        .btn-unavailable {
            padding: 8px 16px;
            margin: 5px;
            margin-bottom: 4px; ;
            /* border: none; */
            border-radius: 54px;
            border: 1PX SOLID black;
            cursor: pointer;
            font-size: 14px;
            color: blue;
            background-color: #27ae60;
            transition: background-color 0.3s;
        }

        .btn-available {
            background-color: #2ecc71;
        }

        .btn-unavailable {
            background-color: #e74c3c;
        }

        .btn-available:hover,
        .btn-unavailable:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>
    <div class="nav bg-gray-300 rounded-xl">
        <div class="navbar">
            <div class="navbar-start">
                <a href="http://localhost/urban-workers/index.html" class="text-green-900 font-weight:900 btn btn-ghost normal-case text-2xl font-bold">Urban Workers</a>
            </div>
        </div>
    </div>

    <p class="header"><b>Workers Information</b> <br> <?php echo $_SESSION['email']; ?></p>
    <hr>
    <div class="card-container">
        <?php
        $email = $_SESSION['email']; // Fetch the logged-in user's email
        $sql = "SELECT * FROM signupworkers WHERE email = '$email'";
        $data = mysqli_query($connection, $sql);
        $count = mysqli_num_rows($data);

        if ($count != 0) {
            $result = mysqli_fetch_assoc($data); // Fetch worker information once
            // Display worker information
            echo "
            <div class='card'>
                <img src='" . $result['picture'] . "' alt='Profile Picture'>
                <div class='card-info'>
                    <h2>" . $result['full_name'] . "</h2>
                    <p>Service: " . $result['services'] . "</p>
                    <p>Address: " . $result['address'] . "</p>
                    <p>Contact: " . $result['contact'] . "</p>
                    <p>Status: " . $result['availability'] . "</p>
                    <p>Rating: " . $result['ratings'] . "</p>
                    <p>admin approval status: " . $result['status'] . "</p>
                    <p>Experienced: " . $result['work_experience'] . "</p>
                </div>

                
                 

                <form method='post' class='button-form'>
                <input type='hidden' name='email' value='" . $email . "'>
                <input type='submit' name='approve' value='Available' class='btn-available' />
                <input type='submit' name='reject' value='Unavailable' class='btn-unavailable' />
            </form>
            
            </div>";

            // Display hire requests and review forms
            $hireRequestSql = "SELECT client_email, status FROM hire_request WHERE worker_email = '{$result['email']}' AND status = 'pending'";

            $hireRequestData = mysqli_query($connection, $hireRequestSql);
            if ($hireRequestData && mysqli_num_rows($hireRequestData) > 0) {
                echo "<div class='card-info'>";
                echo "<h3>Hire Requests</h3>";
                while ($hireRequestResult = mysqli_fetch_assoc($hireRequestData)) {
                    echo "<p>Client Email: " . $hireRequestResult['client_email'] . "</p>";
                    echo "<p>Status: " . $hireRequestResult['status'] . "</p>";
                    echo "<div class='action-buttons'>";
                    echo "<form method='post'>
                            <input type='hidden' name='email' value='" . $email . "'>
                            <input type='hidden' name='worker_email' value='" . $result['email'] . "'>
                            <input type='hidden' name='client_email' value='" . $hireRequestResult['client_email'] . "'>
                            <input type='submit' name='approve_request' value='Approve Request' class='btn-available' />
                        </form>";
                    echo "<form method='post'>
                            <input type='hidden' name='email' value='" . $email . "'>
                            <input type='hidden' name='worker_email' value='" . $result['email'] . "'>
                            <input type='hidden' name='client_email' value='" . $hireRequestResult['client_email'] . "'>
                            <input type='submit' name='reject_request' value='Reject Request' class='btn-unavailable' />
                        </form>";
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No worker available</p>";
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>

</html>