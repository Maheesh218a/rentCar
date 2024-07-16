<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];
$bid = $_GET["id"];

$blog_rs = Database::search("SELECT * FROM `blogs` WHERE `id`='".$bid."'");

$blog_num = $blog_rs->num_rows;

if($blog_num == 1){

    $blog_data = $blog_rs->fetch_assoc();
    $_SESSION["b"] = $blog_data;
    echo ("success");

}else{
    echo ("Something went wrong");
}

?>