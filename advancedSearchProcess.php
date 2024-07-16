<?php
require "connection.php";

// Validate and sanitize inputs
$search_txt = $_POST["text"] ?? '';
$category = $_POST["category"] ?? 0;
$brand = $_POST["brand"] ?? 0;
$seat = $_POST["seats"] ?? 0;
$district = $_POST["district"] ?? 0;
$condition = $_POST["condition"] ?? 0;
$color = $_POST["color"] ?? 0;
$price_from = $_POST["pf"] ?? 0;
$price_to = $_POST["pt"] ?? 0;
$sort = $_POST["sort"] ?? 0;

$page_no = $_POST["page"] ?? 0;

$results_per_page = 5;
$start = $page_no * $results_per_page;

$query = "SELECT * FROM `vehicle` WHERE `status_id` = 1";

// Construct the SQL query based on inputs
if (!empty($search_txt)) {
    $query .= " AND `title` LIKE '%" . $search_txt . "%'";
}
if ($category != 0) {
    $query .= " AND `cat_id` = '" . $category . "'";
}
if ($brand != 0) {
    $query .= " AND `brand_id` = '" . $brand . "'";
}
if ($seat != 0) {
    $query .= " AND `seat` = '" . $seat . "'";
}
if ($district != 0) {
    $query .= " AND `district_id` = '" . $district . "'";
}
if ($condition != 0) {
    $query .= " AND `condition_id` = '" . $condition . "'";
}
if ($color != 0) {
    $query .= " AND `color_id` = '" . $color . "'";
}
if (!empty($price_from) && !empty($price_to)) {
    $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
} else if (!empty($price_from)) {
    $query .= " AND `price` >= '" . $price_from . "'";
} else if (!empty($price_to)) {
    $query .= " AND `price` <= '" . $price_to . "'";
}
switch ($sort) {
    case 1:
        $query .= " ORDER BY `price` ASC";
        break;
    case 2:
        $query .= " ORDER BY `price` DESC";
        break;
    case 3:
        $query .= " ORDER BY `qty` ASC";
        break;
    case 4:
        $query .= " ORDER BY `qty` DESC";
        break;
    default:
        break;
}

$query .= " LIMIT " . $start . ", " . $results_per_page;

$rs2 = Database::search("SELECT * FROM `vehicle` ");
$num_rows = $rs2->num_rows;
$no_of_pages = ceil($num_rows / $results_per_page);

// Display the results
for ($x = 0; $x < $rs->num_rows; $x++) {
    $data = $rs->fetch_assoc();

    // Fetch the corresponding image for each vehicle
    $vehicle_id = $data['id'];
    $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id` = '" . $vehicle_id . "'");
    $img_data = $img_rs->fetch_assoc();
    $img_path = $img_data['img_path'];

    echo "<div class='row singleView'>
            <div class='col-12 col-lg-3'><img src='resources/vehicle_photo/" . $img_path . "' class='img-fluid'></div>
            <div class='col-12 col-lg-9'>
                <h5>" . $data["title"] . "</h5>
                <p>Price: " . $data["price"] . "</p>
                <p>District: " . $data["district_id"] . "</p>
                <p>Condition: " . $data["condition_id"] . "</p>
            </div>
          </div><hr>";
}

// Display pagination
echo "<div class='row'>
        <div class='col-12'>
            <nav>
                <ul class='pagination'>
                    <li class='page-item'><a class='page-link' onclick='advancedSearch(" . ($page_no - 1) . ");'>Previous</a></li>";
for ($x = 0; $x < $no_of_pages; $x++) {
    echo "<li class='page-item'><a class='page-link' onclick='advancedSearch(" . $x . ");'>" . $x . "</a></li>";
}
echo "        <li class='page-item'><a class='page-link' onclick='advancedSearch(" . ($page_no + 1) . ");'>Next</a></li>
                </ul>
            </nav>
        </div>
      </div>";
?>
