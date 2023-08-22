<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "urban-workers";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$clientCountQuery = "SELECT COUNT(*) as client_count FROM clientsignup";
$clientCountResult = $conn->query($clientCountQuery);
$clientCountRow = $clientCountResult->fetch_assoc();

$workerCountQuery = "SELECT COUNT(*) as worker_count FROM signupworkers";
$workerCountResult = $conn->query($workerCountQuery);
$workerCountRow = $workerCountResult->fetch_assoc();

$approvedWorkerCountQuery = "SELECT COUNT(*) as approved_worker_count FROM signupworkers WHERE approval = 1";
$approvedWorkerCountResult = $conn->query($approvedWorkerCountQuery);
$approvedWorkerCountRow = $approvedWorkerCountResult->fetch_assoc();

$conn->close();

$response = [
    'clientCount' => $clientCountRow['client_count'],
    'workerCount' => $workerCountRow['worker_count'],
    'approvedWorkerCount' => $approvedWorkerCountRow['approved_worker_count']
];

header('Content-Type: application/json');
echo json_encode($response);
?>
