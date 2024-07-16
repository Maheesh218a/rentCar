<?php
session_start();

if (isset($_SESSION["u"])) { ?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="adminStyle.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Admin Vehicle Management</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>
    <br class="mt-5">

    <body class="adminBody offset-1 mt-5 mb-5">
        <?php include "adminHeader.php" ?>

        <div class="col-10">
            <h2 class="text-center fw-bold">Vehicle Management</h2>

            <div class="row">

                <!-- Category Register -->
                <div class="col-4 offset-1 mt-4">

                    <label for="form-label">Category Name:</label>
                    <input type="text" class="form-control mb-3" id="cat">

                    <!-- Modal -->
                    <?php include "adminModal.php" ?>
                    <!-- Modal -->

                    <div class="mt-4">
                        <button class="btn btn-outline-light col-12" onclick="categoryReg();">Category Register</button>
                    </div>

                </div>
                <!-- Category Register -->


                <!-- Brand Register -->
                <div class="col-4 offset-1 mt-4">

                    <label for="form-label">Vehicle Brand Name:</label>
                    <input type="text" class="form-control mb-3" id="brand">



                    <div class="mt-4">
                        <button class="btn btn-outline-light col-12" onclick="brandReg();">Brand Register</button>
                    </div>

                </div>
                <!-- Brand Register -->

            </div>

            <div class="row mt-5">

                <!-- Color Register -->
                <div class="col-4 offset-1 mt-4">

                    <label for="form-label">Color Name:</label>
                    <input type="text" class="form-control mb-3" id="color">


                    <div class="mt-4">
                        <button class="btn btn-outline-light col-12" onclick="colorReg();">Color Register</button>
                    </div>

                </div>
                <!-- Color Register -->

                <!-- Size Register -->
                <div class="col-4 offset-1 mt-4">

                    <label for="form-label">Seat Number:</label>
                    <input type="text" class="form-control mb-3" id="size">


                    <div class="mt-4">
                        <button class="btn btn-outline-light col-12" onclick="seatReg();">Seat Register</button>
                    </div>

                </div>
                <div class="mt-5 justify-content-center">
                    <a href="adminAddVehicle.php">
                        <button class="btn btn-info text-center col-12 mt-5">Back to Add New Vehicle</button>
                    </a>
                </div>
                <!-- Size Register -->

            </div>

        </div>

        <script src="adminScript.js"></script>

    </body>

    </html>

<?php

} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Admin Panel</title>
        <link rel="icon" href="resources/logo/lotus.webp">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/style.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />


    </head>

    <body style="background-color: #CCCCCC;">
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

<?php } ?>