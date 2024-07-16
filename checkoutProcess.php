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
    VALUES ('".$payment["order_id"]."', '".$formattedDate."', '".$payment["amount"]."', '".$user["id"]."')");

    $orderHistoryId = Database::$connection->insert_id;

    $rs = Database::search("SELECT * FROM `cart` WHERE `users_id` = '".$user["id"]."' ");
    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $data = $rs->fetch_assoc();
        $cartQty = $data["cart_qty"];
        $vehicleId = $data["vehicle_id"];

        Database::iud("INSERT INTO `order_items` (`oi_qty`, `order_history_ohid`, `vehicle_id`) VALUES ('".$cartQty."', '".$orderHistoryId."', '".$vehicleId."')");
        Database::iud("UPDATE `vehicle` SET `qty` = `qty` - ".$cartQty." WHERE `id` = '".$vehicleId."'");
    }

    Database::iud("DELETE FROM `cart` WHERE `users_id` = '".$user["id"]."'");
    //echo "Success";

    $order = array();
    $order["resp"] = "Success";
    $order["order_id"] = $orderHistoryId;

    echo json_encode($order);

} else {
    echo "Payment data not received";
}
?>
