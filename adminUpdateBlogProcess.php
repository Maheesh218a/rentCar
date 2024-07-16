<?php
session_start();
require "connection.php";

if (isset($_SESSION["b"])) {
    $bid = $_SESSION["b"]["id"];

    $title = $_POST["t"];
    $link = $_POST["l"];
    $s_description = $_POST["s_desc"];
    $description = $_POST["desc"];

    if (empty($title)) {
        echo ("Please Enter Your Blog Title");
    } elseif (strlen($title) > 100) {
        echo ("Your Title Must have less than character 20");
    } elseif (empty($link)) {
        echo ("Please Enter Your Blog Source Link");
    } elseif (empty($s_description)) {
        echo ("Please Enter Your Blog Small Description");
    } elseif (strlen($s_description) > 40) {
        echo ("Your Small Description Must have less than character 40");
    } elseif (empty($description)) {
        echo ("Please Enter Your Blog Description");
    } else {

        $img_path = null;
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "resources/blog_images";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img_path = $target_file;
            } else {
                echo "Failed to upload image.";
                exit();
            }
        }

        $query = "UPDATE `blogs` SET `title` = '$title', `source_link` = '$link', `small_description` = '$s_description', `description` = '$description'";
        if ($img_path) {
            $query .= ", `img_path` = '$img_path'";
        }
        $query .= " WHERE `id` = '$bid'";

        if (Database::search($query)) {
            echo "success";
        } else {
            echo "Failed to update blog.";
        }
    }
} else {
    echo "Blog not found.";
}
