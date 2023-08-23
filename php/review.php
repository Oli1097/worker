<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
    <title>Workers Information</title>
    <style>
     
    </style>
</head>

<body>
   

    <?php
  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... Your existing form submission handling ...

        if (isset($_POST['submit_review'])) {
            $worker_email = $_POST['worker_email'];
            $client_email = $_POST['client_email'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            // Insert the review into the 'reviews' table
            $insertReviewSql = "INSERT INTO reviews (worker_email, client_email, rating, review) VALUES ('$worker_email', '$client_email', '$rating', '$review')";
            if ($conn->query($insertReviewSql) === TRUE) {
                echo "Review submitted successfully.";
            } else {
                echo "Error submitting review: " . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

</body>

</html>
