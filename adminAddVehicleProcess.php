<?php
session_start();
require "connection.php";
$email = $_SESSION["u"]["email"];

$category = $_POST["cat"];
$brand = $_POST["b"];
$color = $_POST["clr"];
$seat = $_POST["s"];
$district = $_POST["d"];
$title = $_POST["t"];
$man_year = $_POST["my"];
$reg_year = $_POST["ry"];
$condition = $_POST["con"];
$contact = $_POST["contact"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$description = $_POST["desc"];

if (empty($category)) {
    echo ("Please Select Your Vehicle Category");
} elseif (empty($brand)) {
    echo ("Please Select Your Vehicle Brand");
} elseif (empty($color)) {
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
} elseif (empty($man_year)) {
    echo ("Please Enter Your Vehicle Manufacturer Year");
} elseif (strlen($man_year) > 4) {
    echo ("Vehicle Vehicle Manufacturer Year Must Have only 4 Characters");
}  elseif (empty($reg_year)) {
    echo ("Please Enter Your Vehicle Manufacturer Year");
} elseif (strlen($reg_year) > 4) {
    echo ("Vehicle Vehicle Manufacturer Year Must Have only 4 Characters");
}   elseif (empty($condition)) {
    echo ("Please Select Your Vehicle Condition");
} elseif (empty($contact)) {
    echo ("Please Select Your Contact Number");
} elseif (!is_numeric($contact)) {
    echo ("Please Enter Only Numbers for Contact Number");
} else if (strlen($contact) != 10) {
    echo ("Contact Number must contain 10 characters");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $contact)) {
    echo ("Invalid Mobile Number!");
} elseif (!is_numeric($qty)) {
    echo ("Please Enter Only Numbers for Quantity");
} elseif (empty($qty)) {
    echo ("Please Enter Your Vehicle Quantity");
} elseif (!is_numeric($cost)) {
    echo ("Please Enter Only Numbers for Vehicle Cost");
} elseif (empty($cost)) {
    echo ("Please Enter Your Vehicle Cost");
} elseif (empty($description)) {
    echo ("Please Enter Your Vehicle Description");
} else {

    $d = new DateTime();
    $time_zone = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($time_zone);
    $date = $d->format("Y-m-d H:i:s");

    $rs = Database::search("INSERT INTO mydb.vehicle (`price`,`qty`,`title`, `contact_no`,`description`,`datetime_added`, `year_made`, `year_register`, `cat_id`,`color_id`,`brand_id`,`seats_id`,`condition_id`,`district_id`,`admin_email`)
    VALUES ('".$cost."', '".$qty."', '".$title."', '".$contact."', '".$description."', '".$date."', '".$man_year."', '".$reg_year."', '".$category."', '".$color."', '".$brand."', '".$seat."', '".$condition."', '".$district."', '".$email."'); ");

    $vehicle_id = Database::$connection->insert_id;
    $length = sizeof($_FILES);

    if ($length <= 4 && $length > 0) {

        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($i = 0; $i < $length; $i++) {
            if (isset($_FILES["img" . $i])) {

                $img_file = $_FILES["img" . $i];
                $file_extention = $img_file["type"];

                if (in_array($file_extention, $allowed_img_extentions)) {

                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resources//vehicle_photo//" . $title . "_" . $i . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `vehicle_img` (`img_path`,`vehicle_id`) VALUES ('" . $file_name . "','" . $vehicle_id . "')");
                } else {
                    echo ("Not an allowed image type.");
                }
            }
        }

        echo ("success");
    } else {
        echo ("You Must Add Least One Photo");
    }
}
