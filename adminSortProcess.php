<?php
session_start();
require "connection.php";
$email = $_SESSION["u"]["email"];
//echo ("OK");


// value="1">Newest to oldest
// value="2">Oldest to newest
// value="3">Price high to low
// value="4">Price low to high 
// value="5">Quantity high to low
// value="6">Quantity low to high

// value="1">Like New
// value="2">Old

$search = $_POST["search"];
$sortBy = $_POST["sort"];
$condition = $_POST["condition"];
$pageno = $_POST["page"];

$query = "SELECT * FROM `vehicle`";

if (!empty($search) && $sortBy == 0 && $condition == 0) {
    $search1 = str_replace(' ', '%', $search);
    $query .= " WHERE `title` LIKE '%" . $search1 . "%'";
} elseif (!empty($search) && $sortBy != 0 && $condition == 0) {
    $search1 = str_replace(' ', '%', $search);

    if ($sortBy == 1) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' ORDER BY `datetime_added` DESC";
    } elseif ($sortBy == 2) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' ORDER BY `datetime_added` ASC";
    } elseif ($sortBy == 3) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' ORDER BY `price` DESC";
    } elseif ($sortBy == 4) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' ORDER BY `datetime_added` ASC";
    } elseif ($sortBy == 5) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' ORDER BY `qty` DESC";
    } elseif ($sortBy == 6) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' ORDER BY `qty` ASC";
    } else {
        echo ("error");
    }
} elseif (!empty($search) && $sortBy != 0 && $condition != 0) {
    $search1 = str_replace(' ', '%', $search);

    if ($sortBy == 1) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "' ORDER BY `datetime_added` DESC";
    } elseif ($sortBy == 2) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "' ORDER BY `datetime_added` ASC";
    } elseif ($sortBy == 3) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "' ORDER BY `price` DESC";
    } elseif ($sortBy == 4) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "' ORDER BY `datetime_added` ASC";
    } elseif ($sortBy == 5) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "' ORDER BY `qty` DESC";
    } elseif ($sortBy == 6) {
        $query .= "WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "' ORDER BY `qty` ASC";
    } else {
        echo ("error");
    }
} elseif (empty($search) && $sortBy != 0 && $condition == 0) {

    if ($sortBy == 1) {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($sortBy == 2) {
        $query .= " ORDER BY `datetime_added` ASC";
    } else if ($sortBy == 3) {
        $query .= " ORDER BY `price` DESC";
    } else if ($sortBy == 4) {
        $query .= " ORDER BY `price` ASC";
    } else if ($sortBy == 5) {
        $query .= " ORDER BY `qty` DESC";
    } else if ($sortBy == 6) {
        $query .= " ORDER BY `qty` ASC";
    } else {
        echo ("error");
    }
} else if (empty($search) && $sortBy != 0 && $condition != 0) {
    if ($sortBy == 1) {
        $query .= " WHERE `condition_id` = '" . $condition . "' ORDER BY `datetime_added` DESC";
    } else if ($sortBy == 2) {
        $query .= " WHERE `condition_id` = '" . $condition . "' ORDER BY `datetime_added` ASC";
    } else if ($sortBy == 3) {
        $query .= " WHERE `condition_id` = '" . $condition . "' ORDER BY `price` DESC";
    } else if ($sortBy == 4) {
        $query .= " WHERE `condition_id` = '" . $condition . "' ORDER BY `price` ASC";
    } else if ($sortBy == 5) {
        $query .= " WHERE `condition_id` = '" . $condition . "' ORDER BY `qty` DESC";
    } else if ($sortBy == 6) {
        $query .= " WHERE `condition_id` = '" . $condition . "' ORDER BY `qty` ASC";
    } else {
        echo ("error");
    }
} else if (empty($search) && $sortBy == 0 && $condition != 0) {
    $query .= " WHERE `condition_id` = '" . $condition . "'";
} else if (!empty($search) && $sortBy == 0 && $condition != 0) {
    $search1 = str_replace(' ', '%', $search);
    $query .= " WHERE `title` LIKE '%" . $search1 . "%' AND `condition_id` = '" . $condition . "'";
} else {
    echo ("error");
}

?>

<!-- Vehicle -->

        <div class="text-center mt-3">
            <div class="row mx-2 mx-md-0 d-flex justify-content-center ">
                <?php

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $vehicle_rs = Database::search("SELECT * FROM `vehicle`");
                $vehicle_num = $vehicle_rs->num_rows;

                $results_per_page = 4;
                $number_of_pages = ceil($vehicle_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs = Database::search("SELECT * FROM `vehicle` LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();

                ?>
                    <!-- card -->
                    <div class="card col-md-4 mb-4 mx-3 rounded-4">
                        <div class="row">
                            <div class="col-md-4 mt-3 mb-2">
                                <?php

                                $vehicle_img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $selected_data["id"] . "'");
                                $Vehicle_img_data = $vehicle_img_rs->fetch_assoc();

                                ?>

                                <img src="<?php echo $Vehicle_img_data["img_path"]; ?>" class="img-fluid rounded-start" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                    <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?>.00</span><br />
                                    <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Vehicle left</span>
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input fs-5" type="checkbox" role="switch" id="<?php echo $selected_data["id"]; ?>" onchange="changeVehicleStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                        <label class="form-check-label fw-bold text-info" for="<?php echo $selected_data["id"]; ?>">
                                            <?php if ($selected_data["status_id"] == 2) { ?>
                                                <p style="color: blue;">Activate This Vehicle</p>
                                            <?php } else {
                                            ?>
                                                <p style="color: red;">Deactivate This Vehicle</p>
                                            <?php
                                            } ?>
                                        </label>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="row g-1">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-outline-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-outline-danger fw-bold" onclick="confirmDelete(<?php echo $selected_data['id']; ?>);">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                <?php } ?>
            </div>
        </div>
        <!-- Pagination -->

        <div class="col-8 col-lg-6 text-center mb-2 offset-3">
            <nav aria-label="Page navigation example">
                <ul class="ms-lg-3 pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php

                    for ($y = 1; $y <= $number_of_pages; $y++) {
                        if ($y == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>

                    <li class="page-item">
                        <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Pagination -->
