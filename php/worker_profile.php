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
            border-radius: 50%;
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
    </style>
</head>

<body>
    <div class="nav bg-gray-300 rounded-xl">
        <div class="navbar">
            <div class="navbar-start">
                <a href="http://localhost/urban-workers-main/index1.php" class="text-green-900 font-weight:900 btn btn-ghost normal-case text-2xl font-bold">Urban Workers</a>
            </div>
        </div>
    </div>
    <p class="header">Workers Information - <?php echo $_GET['email']; ?></p>
    <hr>
    <div class="card-container">
        <?php
        if (isset($_GET['email'])) {
            $email = $_GET['email']; // Fetch the email parameter
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "urban-workers1";
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM signupworkers WHERE email = '$email'";
            $data = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($data);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['approve'])) {
                    $email = $_POST['email'];
                    $updateSql = "UPDATE signupworkers SET availability = 'available' WHERE email = '$email'";
                    if ($conn->query($updateSql) === TRUE) {
                        echo "Status updated successfully.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } elseif (isset($_POST['reject'])) {
                    $email = $_POST['email'];
                    $updateSql = "UPDATE signupworkers SET availability = 'unavailable' WHERE email = '$email'";
                    if ($conn->query($updateSql) === TRUE) {
                        echo "Status updated successfully.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
            if ($count != 0) {
                while ($result = mysqli_fetch_assoc($data)) {
                    echo "
                    <div class='card'>
                        <img src='" . $result['picture'] . "' alt='Profile Picture'>
                        <div class='card-info'>
                            <h2>" . $result['full_name'] . "</h2>
                            <p>Service: " . $result['services'] . "</p>
                            <p>Address: " . $result['address'] . "</p>
                            <p>Contact: " . $result['contact'] . "</p>
                            <p>Status: " . $result['status'] . "</p>
                        </div>
                        <form method='post'>
                            <input type='hidden' name='email' value='" . $email . "'>
                            <input type='submit' name='approve' value='available' />
                            <input type='submit' name='reject' value='unavailable' />
                        </form>
                    </div>";
                }
            } else {
                echo "<p>No data available</p>";
            }
            $conn->close();
        } else {
            echo "<p>Email parameter missing.</p>";
        }
        ?>
    </div>
</body>

</html>