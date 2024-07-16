<?php
require 'connection.php'; // Include your database connection file

// Fetch vehicles
$sql = "SELECT * FROM vehicle";
$result = Database::search($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <title>Vehicles</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body> <br> 
    <div class="container mt-5">
        <h2 class="fw-bold text-center mb-3">All of Vehicles</h2>
        <div class="row">

            <?php
            include "header.php";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Fetch vehicle image
                    $vehicle_id = $row['id'];
                    $img_sql = "SELECT * FROM vehicle_img WHERE vehicle_id='$vehicle_id'";
                    $img_result = Database::search($img_sql);
                    $img_data = $img_result->fetch_assoc();

                    // Card for each vehicle
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 singleView">';
                    echo '<div class="card px-4 border shadow-0 mb-4 mb-lg-0 rounded-2">';
                    echo '<img src="' . $img_data["img_path"] . '" class="card-img-top rounded-2 mt-3" />';
                    echo '<div class="card-body d-flex flex-column pt-3 border-top">';
                    echo '<h4 class="card-title vehicle">' . $row["title"] . '</h4>';
                    echo '<p class="text-muted vehicle">Rs.' . number_format($row["price"]) . '.00</p>';
                    echo '<a class="btn btn-outline-primary btn-sm" href="#" data-abc="true">View Products</a>';
                    echo '<div class="row card-footer bg-white d-flex align-items-center"></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No vehicles found</p>';
            }
            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>