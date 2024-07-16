<?php
require "connection.php";

$vehicle_id = $_GET["p"];

$vehicle_rs = Database::search("SELECT * FROM `vehicle` WHERE `id` = '".$vehicle_id."'");

if ($vehicle_rs->num_rows == 1) {
    $vehicle_data = $vehicle_rs->fetch_assoc();
    $status = $vehicle_data["status_id"];

    if ($status == 1) {
        Database::iud("UPDATE `vehicle` SET `status_id`='2' WHERE `id`='".$vehicle_id."'");
        echo ("Deactivated Successfully");
    } elseif ($status == 2) {
        Database::iud("UPDATE `vehicle` SET `status_id`='1' WHERE `id`='".$vehicle_id."'");
        echo ("Activated Successfully");
    }
    
} else {
    echo ("Something went wrong. Try again later.");
}
?>
