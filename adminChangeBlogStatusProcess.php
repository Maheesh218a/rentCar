<?php
require "connection.php";

$blog_id = $_GET["p"];

$blog_rs = Database::search("SELECT * FROM `blogs` WHERE `id` = '".$blog_id."'");

if ($blog_rs->num_rows == 1) {
    $blog_data = $blog_rs->fetch_assoc();
    $status = $blog_data["status_id"];

    if ($status == 1) {
        Database::iud("UPDATE `blogs` SET `status_id`='2' WHERE `id`='".$blog_id."'");
        echo ("Deactivated");
    } elseif ($status == 2) {
        Database::iud("UPDATE `blogs` SET `status_id`='1' WHERE `id`='".$blog_id."'");
        echo ("Activated");
    }
    
} else {
    echo ("Something went wrong. Try again later.");
}
?>
