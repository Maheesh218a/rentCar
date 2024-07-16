<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];
$pid = $_GET["id"];

$vehicle_rs = Database::search("SELECT * FROM `vehicle` WHERE `id`='".$pid."'");

$vehicle_num = $vehicle_rs->num_rows;

if($vehicle_num == 1){

    $vehicle_data = $vehicle_rs->fetch_assoc();
    $_SESSION["p"] = $vehicle_data;
    echo ("success");

}else{
    echo ("Something went wrong");
}

?>