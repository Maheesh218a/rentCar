<?php
include "connection.php";
session_start();

if (isset($_SESSION["u"])) {

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

    <title>Admin Dashboard</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="adminStyle.css" />

</head>

<?php require "adminHeader.php"; ?>

<body onload="loadChart();">

    <br class="mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="container-wrap" style="background-color:#99CC66;">
                    <aside role="complementary" class="border">
                        <div class="text-center" style="color: black;">
                            <div class="author-img"
                                style="background-image: url(resources/background/image_2.jpg);"></div>
                            <h1 class="text-danger">Maheesha Udalagama</h1>
                            <span class="position">Admin of<h3> Lotus Rent Car Website </h3> </span>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- chart -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 mt-5">
                <h2 class="text-center fw-bold">Most Sold Vehicles</h2>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <!-- chart -->
        <?php

        $user_rs = Database::search("SELECT * FROM `users`  WHERE `email` != 'maheeshaudalagama@gmail.com' ORDER BY `fname` ASC");
        $urows = $user_rs->num_rows;

        $vehicle_rs = Database::search("SELECT * FROM `vehicle`");
        $vehicle_num = $vehicle_rs->num_rows;

        $vehicle_rs2 = Database::search("SELECT * FROM `vehicle` WHERE `status_id` = '2'");
        $vehicle_num2 = $vehicle_rs2->num_rows;

        ?>
        <div class="row gx-xl-5 mt-5">
            <div class="col-md-6 col-lg-3 mb-4 mb-xl-0">
                <!-- Card -->
                <div class="card rounded-4 homeCode">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Number of Registered Users</h5>
                        <p class="card-text"><?php echo ($urows); ?></p>
                        <a href="#" class="btn btn-outline-info">Go somewhere</a>
                    </div>
                </div>
                <!-- Card -->
            </div>

            <div class="col-md-6 col-lg-3 mb-4 mb-xl-0">
                <!-- Card -->
                <div class="card rounded-4 homeCode">
                    <div class="card-header">
                        Vehicles
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Number of Registered Vehicles</h5>
                        <p class="card-text"><?php echo ($vehicle_num); ?></p>
                        <a href="#" class="btn btn-outline-info">Go somewhere</a>
                    </div>
                </div>
                <!-- Card -->
            </div>

            <div class="col-md-6 col-lg-3 mb-4 mb-xl-0">
                <!-- Card -->
                <div class="card rounded-4 homeCode">
                    <div class="card-header">
                        Income
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Income</h5>
                        <p class="card-text"><?php echo ($urows); ?></p>
                        <a href="#" class="btn btn-outline-info">Go somewhere</a>
                    </div>
                </div>
                <!-- Card -->
            </div>

            <div class="col-md-6 col-lg-3 mb-4 mb-xl-0">
                <!-- Card -->
                <div class="card rounded-4 homeCode">
                    <div class="card-header">
                        Vehicles
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Number of Deactive Vehicles</h5>
                        <p class="card-text"><?php echo ($vehicle_num2); ?></p>
                        <a href="#" class="btn btn-outline-info">Go somewhere</a>
                    </div>
                </div>
                <!-- Card -->
            </div>
        </div>
    </div>
    <!-- Section: Summary -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="adminScript.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>

<?php

} else {
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

    <title>Admin Panel</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />


</head>

<body>
    <h1 class="text-center fw-bold">You are not valid admin</h1>
    <h3 class="text-center">Please log in as admin <br> and try again</h3>
    <hr>
    <div class="col-12 text-center">
        <a href="adminIndex.php">
            <button class="btn btn-primary text-center fw-bold">Log In as Admin</button>
        </a>
    </div>
    <hr>
    <div class="text-center">
        <img src="resources/logo/lotus.webp" style="width: 185px;" alt="logo">
        <h4 class="mt-1 mb-5 pb-1">Admin of Lotus Team</h4>
    </div>
    <hr>
    <h5 class="text-end fw-bold">Not Allowed non-authorised Peoples</h5>
    <hr>
</body>

</html>

<?php
}

?>
