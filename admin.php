<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "urban-workers1";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve'])) {
        $email = $_POST['email'];
        $updateSql = "UPDATE signupworkers SET status = 'accepted' WHERE email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Profile approved successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['reject'])) {
        $email = $_POST['email'];
        $updateSql = "UPDATE signupworkers SET status = 'rejected' WHERE email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Profile rejected successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$total_client = "SELECT COUNT(*) FROM signupclient";
$result = $conn->query($total_client);
$row = $result->fetch_row();
$total_clients = $row[0];

$total_worker = "SELECT COUNT(*) FROM signupworkers where status='accepted'";
$result = $conn->query($total_worker);
$row = $result->fetch_row();
$total_worker = $row[0];
?>

<!DOCTYPE HTML>
<html>

<head>
    <title></title>
    <!-- <link rel="stylesheet" href="styleAdmin.css" type="" /> -->
    <style>
        

        body {
            margin: 0px;
            padding: 0px;
            background-color: white;
            overflow: hidden;
            font-family: system-ui;
        }

        .clearfix {
            clear: both;
        }

        .logo {
            margin: 0px;
            margin-left: 28px;
            font-weight: bold;
            color:black;
            margin-right: 10px;
            margin-bottom: 30px;
        }

        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: gray;
            overflow: hidden;
            transition: 0.5s;
            padding-top: 30px;
            color: black;
            margin-right: 10px;
            /* margin-left: 10px; */
        }

        .sidenav a {
            padding: 15px 8px 15px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #c21e1eb7;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
            background-color: #1b203d;
        }

        .sidenav {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
        }

        #main {
            transition: margin-left 0.5s;
            /* background-color: #ddd; */
            /* padding: 16px; */
            margin-left: 300px;
        }

        .head {
            padding: 20px;
            /* color: #131212; */
            font-weight: 700;
        }

        .col-div-6 {
            width: 50%;
            float: left;
            /* color: #131212; */

        }

        .profile {
            display: inline-block;
            float: right;
            width: 160px;
        }

        .pro-img {
            float: left;
            width: 40px;
            margin-top: 5px;
        }

        .profile p {
            color: white;
            font-weight: 500;
            margin-left: 55px;
            margin-top: 10px;
            font-size: 13.5px;
        }

        .profile p span {
            font-weight: 400;
            font-size: 12px;
            display: block;
            color: #8e8b8b;
        }

        .col-div-3 {
            width: 25%;
            float: left;
            color: #131212;

        }

        .box {
            width: 85%;
            height: 120px;
            background-color: rgb(39, 37, 37);
            margin-left: 10px;
            border-radius: 30px;

            padding: 10px;
        }

        .box p {
            font-size: 35px;
            color: white;
            font-weight: bold;
            line-height: 30px;
            padding-left: 10px;
            margin-top: 20px;
            display: inline-block;
        }

        .box p span {
            font-size: 20px;
            font-weight: 600;
            color: #e6e0e0;
        }

        .box-icon {
            font-size: 40px !important;
            float: right;
            margin-top: 35px !important;
            color: #f0e2e2;
            padding-right: 10px;
        }

        .col-div-8 {
            width: 70%;
            float: left;
        }

        .col-div-4 {
            width: 30%;
            float: left;
        }

        .content-box {
            padding: 20px;
        }

        .content-box p {
            margin: 0px;
            font-size: 20px;
            color: #f7403b;
        }

        .content-box p span {
            float: right;
            /* background-color: #ddd; */
            padding: 3px 10px;
            font-size: 15px;
        }

        .box-8,
        .box-4 {
            width: 95%;
            background-color: #272c4a;
            height: 330px;
        }

        .nav2 {
            display: none;
        }

        .box-8 {
            margin-left: 10px;
        }

        .details {
            border: 4px solid red;
            color: #ddd
        }
        .log{
            position: absolute;
            right: 50px;
            font-weight: 600;
            font-size:20px;
            text-decoration: none;
            background-color:red;
            padding: 10px;
            border-radius: 20px;
            color: white;
        
        }
        .bbb{
            color: #131212;
        }
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo">ADMIN</p>
    </div>

    <!-- <p class="logo">Urban Workers</p> -->

    <div id="main">
        <div class="head">
            <a class="log" href="index.html" class="btn btn-ghost normal-case text-2xl">Log Out</a>

            <div class="bbb">
                <span style="font-size:30px;cursor:pointer; color: black;" class="nav">☰ DashBoard</span>
            </div>


            <div class="clearfix"></div>
        </div>

        <br />

        <div class="col-div-3">
            <div class="box">
                <p><?php echo $total_clients; ?><br /><span><b>Client</b></span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p><?php echo $total_worker; ?><br /><span><b>Worker</b></span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div>
        <div>
            <div>
                <h3>Add New Service</h3>
                <form method="post" enctype="multipart/form-data" action="php/addNewService.php">
                    <label for="newService">Service Name:</label>
                    <input type="text" name="service_name" required>
                    <button type="submit" name="addService">Add Service</button>
                   
                    
                </form>
            </div>
        </div>
        

        <br><br><br><br><br><br><br>

        <div>
            <?php
            $profileSql = "SELECT * FROM signupworkers WHERE status= 'pending'";
            $profileResult = $conn->query($profileSql);

            if ($profileResult->num_rows > 0) {
                while ($profileData = $profileResult->fetch_assoc()) {
                    $email = $profileData["email"];
            ?>
                    <div>
                        <p>Worker Profile</p>
                        <p>Name: <?php echo $profileData["full_name"]; ?></p>
                        <p>Email: <?php echo $profileData["email"]; ?></p>
                        <p>Status: <?php echo $profileData["status"]; ?></p>

                        <form method="post">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="submit" name="approve" value="Approve" />
                            <input type="submit" name="reject" value="Reject" />
                        </form>
                    </div>
                    <br>
            <?php
                }
            } else {
                echo "No pending worker profiles.";
            }
            ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(".nav").click(function() {
            $("#mySidenav").css('width', '70px');
            $("#main").css('margin-left', '70px');
            $(".logo").css
        })
    </script>
</body>

</html>