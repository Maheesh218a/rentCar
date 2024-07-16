<?php
//echo("OK");
session_start();
require "connection.php";
$email = $_SESSION["u"]["email"];

if (isset($_GET["id"])) {
    $bid = $_GET["id"];

    Database::iud(("DELETE FROM `blogs` WHERE `id` = '" . $bid . "' AND `admin_email` = '" . $email . "'"));

    echo ("success");
} else {
    echo ("Product ID not Provided");
}
