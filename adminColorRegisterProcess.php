<?php

include "connection.php";

$color = $_POST["c"];
//echo ($cat);

if (empty($color)) {
    echo ("Please Enter Your Color");
} elseif (strlen($color) > 50) {
    echo ("Your Color should be less than 20 characters");
} else {

    $rs = Database::search("SELECT * FROM `color` WHERE `color_name` = '" . $color . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("Your Color Name is Already Exists");
    } else {
        Database::iud("INSERT INTO `color` (`color_name`) VALUES ('" . $color . "')");
        echo ("Success");
    }
}
