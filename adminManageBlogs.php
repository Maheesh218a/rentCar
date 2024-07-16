<?php

session_start();

if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="adminStyle.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Blogs</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body class="adminBody">
        <?php require "adminHeader.php"; ?>

        <div class="col-10">
            <h2 class="text-center fw-bold">Blogs</h2>

            <div class="row mt-5">

                <div class="col-6 mt-5">
                    <a href="adminBlogs.php"><button class="btn btn-outline-info col-12">View Blogs</button></a>
                </div>

                <div class="col-6 mt-5">
                    <a href="adminAddNewBlog.php"><button class="btn btn-outline-info col-12">Add New Blogs</button></a>
                </div>

            </div>

        </div>

        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php } else {
    header("Location:adminIndex.php");
} ?>