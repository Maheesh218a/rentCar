<?php

include "connection.php";

$seat = $_POST["s"];
//echo ($cat);

if (empty($seat)) {
    echo ("Please Enter Your Seat Numbers");
} elseif (strlen($seat) > 50) {
    echo ("Your size should be less than 3 characters");
} else {

    $rs = Database::search("SELECT * FROM `seats` WHERE `seat_numbers` = '" . $seat . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("Your Seat Number is Already Exists");
    } else {
        Database::iud("INSERT INTO `seats` (`seat_numbers`) VALUES ('" . $seat . "')");
        echo ("Success");
    }
}
