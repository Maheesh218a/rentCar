<?php

include "connection.php";

$cat = $_POST["c"];
//echo ($cat);

if (empty($cat)) {
    echo ("Please Enter Your Category");
} elseif (strlen($cat) > 50) {
    echo ("Your Category should be less than 20 characters");
} else {

    $rs = Database::search("SELECT * FROM `category` WHERE `cat_name` = '" . $cat . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("Your Category Name is Already Exists");
    } else {
        Database::iud("INSERT INTO `category` (`cat_name`) VALUES ('" . $cat . "')");
        echo ("Success");
    }
}
