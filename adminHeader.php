<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="adminStyle.css" />

</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-dark bg-dark fixed-top">
        <div class="container">
            <img class="me-3" src="Resources/logo/lotus.webp" height="25">
            <a class="navbar-brand fw-bold" href="adminHome.php">LOTUS<span style="color: darkgoldenrod;"> SELLING CAR</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">

                    <li class="nav-item me-5">
                        <a class="nav-link" aria-current="page" href="adminUserManagement.php">User Management</a>
                    </li>

                    <li class="nav-item me-5">
                        <a class="nav-link" aria-current="page" href="adminAddVehicle.php">Add New Vehicle</a>
                    </li>

                    <li class="nav-item me-5">
                        <a class="nav-link" aria-current="page" href="adminManageVehicle.php">Vehicle Management</a>
                    </li>

                    <li class="nav-item me-5">
                        <a class="nav-link" aria-current="page" href="adminManageBlogs.php">Edit Blogs</a>
                    </li>

                    <li class="nav-item me-5">
                        <a class="nav-link" aria-current="page" href="adminReport.php">Reports</a>
                    </li>

                    <li class="nav-item me-5">

                        <?php

                        if (isset($_SESSION["u"])) {
                            $data = $_SESSION["u"]; ?>

                            <a class="nav-link" aria-current="page" onclick="signout();">Sign Out</a>

                        <?php } ?>

                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>