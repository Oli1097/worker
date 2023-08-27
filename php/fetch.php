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
            font-weight: 700;
            font-size: 30px;
            text-align: center;
            margin-top: 20px;
        }

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;

            background-color: #f6f9f2;
            padding: 20px;
            margin-bottom: 10px;

        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 26px;
            width: calc(100% - 20px);
            margin: 10px;
            display: flex;
            flex-wrap: wrap;

            justify-content: center;

            /* align-items: center; */
            background-color: #dbc7c2;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding-bottom: 20px;
        }

        .card img {
            max-width: 300px;
            height: 200px;
            border-radius: 50%;
            /* object-fit: cover; */
            flex: 0 0 100px;
            /* margin-right: 20px; */
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

        .reviews {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .reviews h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .reviews table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .reviews th,
        .reviews td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .reviews th {
            background-color: #f2f2f2;
        }

        button[type='submit'] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        button[type='submit']:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <div class="nav bg-gray-300 rounded-xl">
        <div class="navbar">
            <div class="navbar-start">
                <a href="http://localhost/urban-workers/index1.php" class="text-green-900 font-weight:900 btn btn-ghost normal-case text-2xl font-bold">Urban Workers</a>
            </div>
        </div>
    </div>
    <p class="header">Workers Information - <?php echo $_GET['service']; ?></p>
    <hr>
    

        <div class="card-container">
            <?php
            session_start();
            if (isset($_GET['service'])) {
                $service = $_GET['service'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "urban-workers1";
                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM signupworkers WHERE services = '$service' AND status = 'accepted'";
                $data = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($data);

                if ($count != 0) {
                    $workerCount = 0;
                    echo "<div class='card-row'>";
                    while ($result = mysqli_fetch_assoc($data)) {
                        echo "
                    <div class='card'>
                        <img src='" . $result['picture'] . "' alt='Profile Picture'>
                        <div class='card-info'>
                            <h2>" . $result['full_name'] . "</h2>
                            <p>email: " . $result['email'] . "</p>
                            <p>Service: " . $result['services'] . "</p>
                            <p>Address: " . $result['address'] . "</p>
                            <p>Contact: " . $result['contact'] . "</p>
                            <p>Ratings: " . $result['ratings'] . "</p>
                            <p>Status: " . $result['status'] . "</p>
                            <p>Honorarium range per hour: " . $result['Honorarium'] . "</p>
                            <p>Experience: " . $result['work_experience'] . "</p>
                            <p>
                                <form action='send_request.php' method='post'>
                                    <input type='hidden' name='worker_id' value='" . $result['ID'] . "'>
                                    <input type='hidden' name='worker_email' value='" . $result['email'] . "'>
                                    <button type='submit'>Send Request</button>
                                </form>
                            </p>
                        </div>
                        
                        <div class='reviews'>";

                        // Display worker reviews for clients
                        $workerEmail = $result['email'];
                        $reviewsQuery = "SELECT client_email, rating, review FROM hire_request WHERE worker_email = '$workerEmail' AND review IS NOT NULL";
                        $reviewsResult = mysqli_query($conn, $reviewsQuery);

                        if (mysqli_num_rows($reviewsResult) > 0) {
                            echo "
                            <h3>Reviews:</h3>
                            <table border='1'>
                                <tr>
                                    <th>Client Email</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                </tr>";
                            while ($reviewRow = mysqli_fetch_assoc($reviewsResult)) {
                                echo "
                                <tr>
                                    <td>" . $reviewRow['client_email'] . "</td>
                                    <td>" . $reviewRow['rating'] . "</td>
                                    <td>" . $reviewRow['review'] . "</td>
                                </tr>";
                            }
                            echo "
                            </table>";
                        } else {
                            echo "<p>No reviews available.</p>";
                        }

                        echo "
                        </div>
                    </div>";

                        $workerCount++;
                        if ($workerCount === 3) {
                            echo "</div><div class='card-row'>";
                            $workerCount = 0;
                        }
                    }
                    echo "</div>";
                } else {
                    echo "<p>No worker available</p>";
                }
                $conn->close();
            } else {
                echo "<p>Service parameter missing.</p>";
            }
            ?>
        </div>
</body>

</html>