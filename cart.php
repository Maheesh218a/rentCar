<?php
session_start();
include "connection.php";
$user = $_SESSION["u"];

if (isset($user)) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Vehicle Cart</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body style="background-color: #ffffd1;" onload="loadCart();">
        <?php include "header.php"; ?>

        <div class="container mt-5">
            <div class="row" id="cardBody">
                <!-- Cart items will be dynamically loaded here -->
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>

    </html>

<?php } else {
    header("location: signIn.php");
}
?>