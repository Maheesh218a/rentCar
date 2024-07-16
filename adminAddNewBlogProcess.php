<?php
//echo("ok");
session_start();
require "connection.php";
$email = $_SESSION["u"]["email"];

$title = $_POST["title"];
$author = $_POST["author"];
$link = $_POST["link"];
$small_description = $_POST["s_description"];
$description = $_POST["description"];

//echo($title);
//echo($small_description);
//echo($description);

if (empty($title)) {
    echo ("Please Enter Your Blog Title");
} elseif (strlen($title) > 100) {
    echo ("Your Title Must have less than character 20");
} elseif (empty($author)) {
    echo ("Please Enter Your Blog Small Description");
} elseif (strlen($author) > 20) {
    echo ("Your Author Name Must have less than character 20");
} elseif (empty($link)) {
    echo ("Please Enter Your Blog Source Link");
} elseif (empty($small_description)) {
    echo ("Please Enter Your Blog Small Description");
} elseif (strlen($small_description) > 40) {
    echo ("Your Small Description Must have less than character 40");
} elseif (empty($description)) {
    echo ("Please Enter Your Blog Description");
} else {

    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];

        $d = new DateTime();
        $time_zone = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($time_zone);
        $date = $d->format("Y-m-d H:i:s");

        $path = "resources/blog_images/" . uniqid() . ".png";
        move_uploaded_file($image["tmp_name"], $path);

        $rs =  Database::search("SELECT * FROM `blogs` WHERE `title` = '" . $title . "'");
        $num = $rs->num_rows;

        if ($num > 0) {
            echo ("Blog has been already registered!");
        } else {
            Database::iud(("INSERT INTO mydb.blogs (`title`,`author`, `source_link`, `small_description`,`description`,`date_addon`,`img_path`,`admin_email`)
            VALUES ('" . $title . "', '" . $author . "', '" . $link . "', '" . $small_description . "', '" . $description . "', '" . $date . "', '" . $path . "', '" . $email . "')"));

            echo ("Success");
        }
    } else {
        echo ("Please select a blog image");
    }
}
