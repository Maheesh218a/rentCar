<?php
include "connection.php";
session_start();

$rs = Database::search("SELECT vehicle.id, vehicle.title, SUM(order_items.oi_qty) AS total_sold
                        FROM order_items 
                        INNER JOIN vehicle ON order_items.vehicle_id = vehicle.id
                        GROUP BY vehicle.id, vehicle.title 
                        ORDER BY total_sold DESC LIMIT 5");

$num = $rs->num_rows;

$labels = array();
$data = array();

// Fetch data and store in arrays
while ($row = $rs->fetch_assoc()) {
    $labels[] = $row["title"];
    $data[] = $row["total_sold"];
}

// Create JSON response
$response = array(
    "labels" => $labels,
    "data" => $data
);

// Encode JSON and send response
echo json_encode($response);
?>
