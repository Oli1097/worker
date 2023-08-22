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

$total_worker = "SELECT COUNT(*) FROM signupworkers";
$result = $conn->query($total_worker);
$row = $result->fetch_row();
$total_worker = $row[0];
?>

<!DOCTYPE HTML>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="styleAdmin.css" type="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo">ADMIN</p>
    </div>

    <p class="logo">Urban Workers</p>

    <div id="main">
        <div class="head">
            <a href="index.html" class="btn btn-ghost normal-case text-xl">Urban Workers</a>

            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav">☰ Urban Workers</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Urban Workers</span>
            </div>

            <div class="col-div-6">
                <div class="profile">
                </div>
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
        <div class="col-div-3">
            <div class="box">
                <p>00<br /><span>Approval status</span></p>
                <i class="fa fa-users box-icon"></i>
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
    </script>
</body>

</html>
