<?php
include "connection.php";

if (isset($_POST["c"])) {
    $cartId = $_POST["c"];
    Database::iud("DELETE FROM `cart` WHERE `cart_id` = '".$cartId."' ");
    echo("Item Successfully Removed From Cart");
} else {
    echo("Error: cart ID not provided.");
}
?>
