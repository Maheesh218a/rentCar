<?php
session_start();
require "connection.php";
//echo("ok");

if ($_SESSION["p"]) {
    $vid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $contact = $_POST["contact"];
    $color = $_POST["clr"];
    $seat = $_POST["s"];
    $qty = $_POST["q"];
    $cost = $_POST["cos"];
    $description = $_POST["desc"];
    $condition = $_POST["con"];
    $district = $_POST["dis"];

    //echo($title);
    //echo($color);
    //echo($seat);
    //echo($qty);
    //echo($cost);
    //echo($description);
    //echo($condition);

    if (empty($color)) {
        echo ("Please Select Your Vehicle Color");
    } elseif (empty($seat)) {
        echo ("Please Select Your Vehicle Number of Seats");
    } elseif (!is_numeric($seat)) {
        echo ("Please Enter Only Numbers for Seats");
    } elseif (empty($district)) {
        echo ("Please Select Your District");
    } elseif (empty($title)) {
        echo ("Please Enter Your Vehicle Title");
    } elseif (strlen($title) > 45) {
        echo ("Vehicle Title Must Have only 45 Characters");
    } elseif (empty($condition)) {
        echo ("Please Select Your Vehicle Condition");
    } elseif (!is_numeric($contact)) {
        echo ("Please Enter Only Numbers for Contact Number");
    } else if (strlen($contact) != 10) {
        echo ("Contact Number must contain 10 characters");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $contact)) {
        echo ("Invalid Mobile Number!");
    }  elseif (!is_numeric($qty)) {
        echo ("Please Enter Only Numbers for Quantity");
    } elseif (empty($qty)) {
        echo ("Please Enter Your Vehicle Quantity");
    } elseif (!is_numeric($cost)) {
        echo ("Please Enter Only Numbers for Vehicle Cost for per day");
    } elseif (empty($cost)) {
        echo ("Please Enter Your Vehicle Cost for per day");
    } elseif (empty($description)) {
        echo ("Please Enter Your Vehicle Description");
    } else {

        Database::search("UPDATE `vehicle` SET `price` = '" . $cost . "', `qty` = '" . $qty . "', `title` = '" . $title . "', `description` = '" . $description . "', `color_id` = '" . $color . "', `seats_id` = '" . $seat . "', `condition_id` = '" . $condition . "', `district_id` = '" . $district . "', `contact_no`='".$contact."' WHERE `id`='" . $vid . "'");
        echo ("success");
       
    }
} else {
    echo ("No vehicle selected.");
}
