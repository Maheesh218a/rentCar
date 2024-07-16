<?php

require "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `vehicle`";

if (!empty($txt) && $select == 0) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' AND (`status_id` = '1' AND `qty` != '0')";
} else if (empty($txt) && $select != 0) {
    $query .= " WHERE `cat_id`='" . $select . "' AND (`status_id` = '1' AND `qty` != '0')";
} else if (!empty($txt) && $select != 0) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' AND `cat_id`='" . $select . "' AND (`status_id` = 1 OR `qty` = 0)";
} else {
    $query .= " WHERE `status_id` = 1 OR `qty` = 0";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php


            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;


            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();
                $product_data = $product_rs->fetch_assoc();

            ?>

                <div class="col-md-3 col-sm-6 mb-4 mt-4">
                    <div class="card">
                        <a href="<?php echo "singleVehicleView.php?id=" . ($product_data["id"]); ?>" class="">
                            <?php
                            $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $product_data["id"] . "'");
                            $img_data = $img_rs->fetch_assoc();
                            ?>
                            <img src="<?php echo $img_data["img_path"] ?>" class="card-img-top" alt="<?php echo $product_data["title"] ?>">
                        </a>
                        <div class="card-body text-center">
                            <a href="<?php echo "singleVehicleView.php?id=" . ($product_data["id"]); ?>" class="">
                                <h4 class="card-title"><?php echo $product_data["title"] ?></h4>
                            </a>
                            <p class="text-muted">Rs.<?php echo $product_data["price"] ?>.00</p>
                            <a class="btn btn-outline-primary btn-sm" href="singleVehicleView.php?id=<?php echo $product_data["id"]; ?>" data-abc="true">View Vehicle</a>
                        </div>
                    </div>
                </div>

            <?php

            }
            ?>



        </div>
    </div>
    <!--  -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->
</div>