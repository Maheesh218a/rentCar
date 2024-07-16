<?php
include "connection.php";
//echo("OK")

$pageno = 0;
$page = $_POST["p"];

if (0 != $page) {
    $pageno = $page;
} else {
    $pageno = 1;
}

$vehicle = "SELECT * FROM `vehicle` INNER JOIN `status` ON  `vehicle`.status_id = `status`.status_id INNER JOIN `condition` ON `vehicle`.condition_id = `condition`.condition_id WHERE `vehicle`.status_id='1' ORDER BY `datetime_added` DESC";
$product_rs = Database::search($vehicle);
$product_num = $product_rs->num_rows;
$product_data = $product_rs->fetch_assoc();
//echo($num);

$result_per_page = 6;
$num_of_pages = ceil($product_num / $result_per_page);
//echo($num_of_pages);

$page_result = ($pageno - 1) * $result_per_page;
//echo($page_result);

$vehicle2 = $vehicle . " LIMIT $result_per_page OFFSET $page_result";
$vehicle_rs2 = Database::search("$vehicle2");
$vehicle_num2 = $vehicle_rs2->num_rows;
//echo($num2);



if ($vehicle_num2 == 0) {
    echo ("No Vehicles Here....");
} else {
        //Load Vehicles
?>
        <u class="fw-bold">
            <h2 class="vehicle text-center">Featured <b>Vehicles</b></h2>
        </u>

        <?php
       for ($x = 0; $x < $product_num; $x++) {
            $vehicle_data = $vehicle_rs2->fetch_assoc();

            $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $vehicle_data["id"] . "'");
            $img_data = $img_rs->fetch_assoc();

        ?>
            <!-- Load Vehicles -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card px-4 border shadow-0 mb-4 mb-lg-0 rounded-2">

                        <?php

                        $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $product_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();

                        ?>

                        <img src="<?php echo $img_data["img_path"] ?>" class="card-img-top rounded-2 mt-3" />

                        <div class="card-body d-flex flex-column pt-3 border-top">
                            <h4 class="card-title vehicle"><?php echo $product_data["title"] ?></h4>
                            <p class="text-muted vehicle">Rs.<?php echo $product_data["price"] ?>.00</p>
                            <a class="btn btn-outline-primary btn-sm" href="#" data-abc="true">View Products</a>
                            <div class="row card-footer bg-white d-flex align-items-center">

                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }
            ?>

            </div>
            <!-- Load Vehicles -->

        <?php } ?>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5 mb-5">

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" <?php

                                                                if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="loadProduct(<?php echo ($pageno - 1) ?>);" <?php  } ?>>Previous</a></li>

                    <?php
                    for ($y = 0; $y <= $num_of_pages; $y++) {
                        if ($y == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" onclick="loadProduct(<?php echo $y ?>);"> <?php echo $y ?> </a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="loadProduct(<?php echo $y ?>);"> <?php echo $y ?> </a>
                            </li>
                    <?php
                        }
                    }
                    ?>

                    <li class="page-item"><a class="page-link" <?php

                                                                if ($pageno >= $num_of_pages) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="loadProduct(<?php echo ($pageno + 1) ?>);" <?php  } ?>>Next</a></li>
                </ul>
            </nav>

        </div>
        <!-- Pagination -->