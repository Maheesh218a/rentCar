<?php
include "connection.php";
session_start();
$user = $_SESSION["u"];

$stockList = array();
$qtyList = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    //From Cart
    $rs = Database::search("SELECT * FROM `cart` WHERE `users_id` = '".$user["id"]."' ");
    $num = $rs->num_rows;

    for ($i=0; $i < $num; $i++) { 
        $d = $rs->fetch_assoc();

        $stockList[] = $d["vehicle_id"];
        $qtyList[] = $d["cart_qty"];
    }
} else {
    //From Buy Now
    //echo("buy now");
    $stockList[] = $_POST["vehicleId"];
    $qtyList[] = $_POST["qty"];
}

$merchantId = "1224421";
$merchantSecret = "MjMzNTgxODk3NjY0NTk4NjgxNDMyNjQ3Njg0NTkyMzc5MzU0NjUy";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i=0; $i < sizeof($stockList); $i++) { 
    $rs2 = Database::search("SELECT * FROM `vehicle` WHERE `vehicle`.`id` = '".$stockList[$i]."' ");
    $d2 = $rs2->fetch_assoc();
    $stockQty = $d2["qty"];

    if ($stockQty >= $qtyList[$i]) {
        //stock available
        $items = $d2["title"];

        if ($i != sizeof($stockList) - 1) {
            $items .= ", ";
        }

        $netTotal += (intval($d2["price"] * intval($qtyList[$i])));
    } else {
        echo("Vehicle Has No Available Stocks");
        exit;
    }
}

//delivery fee
//$netTotal += 500;

$hash = strtoupper(
    md5(
        $merchantId . 
        $orderId . 
        number_format($netTotal, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchantSecret)) 
    ) 
);

$payment = array();
$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["fname"];
$payment["last_name"] = $user["lname"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile"];
$payment["address"] = "Number";
$payment["city"] = "line1";
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);
?>
