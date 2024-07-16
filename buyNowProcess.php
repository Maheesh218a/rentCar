<?php
include "connection.php";
session_start();
$user = $_SESSION["u"];

if (isset($_POST["payment"])) {
    $payment = json_decode($_POST["payment"], true);

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $formattedDate = $date->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `order_history` (`order_id`,`order_date`,`amount`,`users_id`)
    VALUES ('" . $payment["order_id"] . "', '" . $formattedDate . "', '" . $payment["amount"] . "', '" . $user["id"] . "')");

    $orderHistoryId = Database::$connection->insert_id;

    Database::iud("INSERT INTO `order_items` (`oi_qty`,`order_history_ohid`,`vehicle_id`)
    VALUES ('" . $payment["qty"] . "', '" . $orderHistoryId . "', '" . $payment["vehicle_id"] . "')");

    $rs = Database::search("SELECT * FROM `vehicle` WHERE `id` = '" . $payment["vehicle_id"] . "' ");
    $d = $rs->fetch_assoc();

    $newQty = $d["qty"] - $payment["qty"];
    Database::iud("UPDATE `vehicle` SET `qty` = '" . $newQty . "' WHERE `id` = '" . $payment["vehicle_id"] . "' ");
    //echo("Success");

    $order = array();
    $order["resp"] = "Success";
    $order["order_id"] = $orderHistoryId;

    echo json_encode($order);
}
