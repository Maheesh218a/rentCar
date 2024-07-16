<?php

require "connection.php";

$text = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `vehicle` INNER JOIN `category` ON vehicle.cat_id = category.cat_id 
INNER JOIN `status` ON vehicle.status_id = status.status_id 
INNER JOIN `condition` ON vehicle.condition_id = condition.condition_id ";

if (!empty($text) && $select == 0) {

    $query .= "WHERE `title` LIKE '%" . $text . "%'";
} else if (empty($text) && $select != 0) {

    $query .= "WHERE `cat_id`='" . $select . "'";
} else if (!empty($text) && $select != 0) {

    $query .= "WHERE `title` LIKE '%" . $text . "%' AND `cat_id`='" . $select . "'";
}

?>