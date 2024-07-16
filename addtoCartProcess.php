<?php
include "connection.php";
session_start();

// Check if the session 'u' array is set and contains the 'id' key
if (!isset($_SESSION["u"]["id"])) {
    die("Please Sign in to add to cart");
}

$user = $_SESSION["u"];
$userId = $user["id"];
$vehicleId = $_POST["v"];
$qty = $_POST["q"];

// Debugging: Echo the received values
//echo("Stock ID: " . $vehicleId);
//echo("Quantity: " . $qty);

if (!isset($_SESSION["u"]["id"])) {
    die("Please Sign in to add to cart");
}

$rs = Database::search("SELECT * FROM `vehicle` WHERE `id` = '".$vehicleId."'");
$num = $rs->num_rows;

if ($num > 0) {
    $d = $rs->fetch_assoc();
    $stockQty = $d["qty"];

    $rs2 = Database::search("SELECT * FROM `cart` WHERE `users_id` = '".$userId."' AND `vehicle_id` = '".$vehicleId."' ");
    $num2 = $rs2->num_rows;

    if ($num2 > 0) {
        // Update cart item
        $d2 = $rs2->fetch_assoc();
        $newQty = $qty + $d2["cart_qty"];

        if ($stockQty >= $newQty) {
            // Update query
            Database::iud("UPDATE `cart` SET `cart_qty` = '".$newQty."' WHERE `cart_id` = '".$d2["cart_id"]."'");
            echo "Cart item updated successfully";
        } else {
            echo "Stock Quantity has been exceeded!";
        }
    } else {
        // Insert new cart item
        if ($stockQty >= $qty) {
            Database::iud("INSERT INTO `cart` (`cart_qty`, `users_id`, `vehicle_id`) VALUES ('".$qty."', '".$userId."', '".$vehicleId."')");
            echo "Cart item added successfully";
        } else {
            echo "Stock Quantity has been exceeded!";
        }
    }
} else {
    echo "Your stock is not found!";
}
?>
