<?php
include "connection.php";

$cartId = $_POST['c'];
$newQty = $_POST['q'];
//echo($newQty);

$rs = Database::search("SELECT * FROM `cart` INNER JOIN `vehicle` ON `cart`.`vehicle_id` = `vehicle`.`id` 
WHERE `cart`.`cart_id` = '".$cartId."' ");

$num = $rs->num_rows;

if ($num > 0) {
    //cart item found
    $d = $rs->fetch_assoc();

    if ($d["qty"] >= $newQty) {
        //update query
        Database::search("UPDATE `cart` SET `cart_qty` = '".$newQty."' WHERE `cart_id` = '".$cartId."' ");
        echo("Success");

    } else {
        echo("Your Vehicle Quantity Exceeded!!!");

    }
    

} else {
   echo("cart item not found");
}
