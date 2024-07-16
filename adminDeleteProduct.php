<?php
//echo("OK");
session_start();
require "connection.php";
$email = $_SESSION["u"]["email"];

if (isset($_GET["id"])) {
    $vid = $_GET["id"];

    Database::iud(("DELETE FROM `vehicle_img` WHERE `vehicle_id` = '" . $vid . "'"));
    Database::iud(("DELETE FROM `vehicle` WHERE `id` = '" . $vid . "' AND `admin_email` = '" . $email . "'"));

    echo ("success");
} else {
    echo ("Product ID not Provided");
}
