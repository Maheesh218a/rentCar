<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_SESSION["p"])) {
        $vehicle = $_SESSION["p"];
?>

        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="adminStyle.css">
            <link rel="stylesheet" href="bootstrap.css">
            <title>Vehicle Update</title>
            <link rel="icon" href="resources/logo/lotus.webp">
        </head>

        <body>
            <?php include "adminHeader.php" ?>

            <br>
            <div class="container my-5 mt-5">
                <div class="card mt-6 shadow-6-strong">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Update vehicle</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Update Vehicle Title</label>
                                <input type="text" class="form-control" id="title" value="<?php echo ($vehicle["title"]); ?>" placeholder="Enter Vehicle title">
                            </div>
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="VehicleCondition" class="form-label">Current Vehicle images</label>
                                        <div class="row">
                                            <?php

                                            $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id` = '" . $vehicle["id"] . "'");
                                            $img_num = $img_rs->num_rows;

                                            for ($i = 0; $i < $img_num; $i++) {
                                                $img_data = $img_rs->fetch_assoc();
                                            ?>

                                                <div class="col-6 col-md-3">
                                                    <img src="<?php echo $img_data["img_path"] ?>" class="card-img-top">
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label" for="contact">Update Your Contact Number</label>
                                        <input type="text" class="form-control" id="contact" value="<?php echo ($vehicle["contact_no"]); ?>" placeholder="Enter Vehicle title">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="condition">Update Vehicle Condition</label>
                                        <select class="form-select" id="condition">
                                            <option value="0">Select Condition</option>
                                            <?php

                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($i = 0; $i < $condition_num; $i++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                                if ($vehicle["condition_id"] == $condition_data["condition_id"]) {
                                            ?>
                                                    <option value="<?php echo $condition_data["condition_id"]; ?>" selected><?php echo $condition_data["condition_name"]; ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>
                                            <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="district">Update Vehicle District</label>
                                        <select class="form-select" id="district">
                                            <option value="0">Select District</option>
                                            <?php

                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $district_num = $district_rs->num_rows;

                                            for ($i = 0; $i < $district_num; $i++) {
                                                $district_data = $district_rs->fetch_assoc();
                                                if ($vehicle["district_id"] == $district_data["district_id"]) {
                                            ?>
                                                    <option value="<?php echo $district_data["district_id"]; ?>" selected><?php echo $district_data["district_name"]; ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $district_data["district_id"]; ?>"><?php echo $district_data["district_name"]; ?></option>
                                            <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="color">Update Vehicle Color</label>
                                    <select class="form-select" id="color">
                                        <option value="0">Select Color</option>
                                        <?php

                                        $color_rs = Database::search("SELECT * FROM `color`");
                                        $color_num = $color_rs->num_rows;

                                        for ($i = 0; $i < $color_num; $i++) {
                                            $color_data = $color_rs->fetch_assoc();
                                            if ($vehicle["color_id"] == $color_data["color_id"]) {
                                        ?>
                                                <option value="<?php echo $color_data["color_id"]; ?>" selected><?php echo $color_data["color_name"]; ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $color_data["color_id"]; ?>"><?php echo $color_data["color_name"]; ?></option>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                    <div class="mt-2">
                                        <a href="adminAddNewCat.php">
                                            <button type="button" class="btn btn-outline-light btn-sm mt-2">Add New Color</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" for="seat">Update Vehicle Number of Seats</label>
                                    <select class="form-select" id="seat">
                                        <option value="0">Select Seats</option>
                                        <?php

                                        $color_rs = Database::search("SELECT * FROM `seats`");
                                        $color_num = $color_rs->num_rows;

                                        for ($i = 0; $i < $color_num; $i++) {
                                            $color_data = $color_rs->fetch_assoc();
                                            if ($vehicle["seats_id"] == $color_data["seats_id"]) {
                                        ?>
                                                <option value="<?php echo $color_data["seats_id"]; ?>" selected><?php echo $color_data["seat_numbers"]; ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $color_data["seats_id"]; ?>"><?php echo $color_data["seat_numbers"]; ?></option>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                    <div class="mt-2">
                                        <a href="adminAddNewCat.php">
                                            <button type="button" class="btn btn-outline-light btn-sm mt-2">Add New Number of Seats</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="qty">Update Vehicle Quantity</label>
                                    <input type="number" class="form-control" value="<?php echo ($vehicle["qty"]); ?>" min="1" id="qty" placeholder="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="cost">Update Cost Per Item (Rs.)</label>
                                    <input type="number" class="form-control" id="cost" min="1" value="<?php echo ($vehicle["price"]); ?>" placeholder="0.00">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="desc">Update Vehicle Description</label>
                                <textarea class="form-control" id="desc" rows="5" placeholder=""><?php echo ($vehicle["description"]); ?></textarea>
                            </div>

                            
                        </div>
                        <button class="btn btn-outline-info" onclick="updateVehicle();">Save Vehicle</button>
                    </div>
                </div>
            </div>
            </div>
            <?php include "adminFooter.php"; ?>

            <script src="adminScript.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
    <?php } else { ?>
        <script>
            alert("Please select a Vehicle.");
            window.location = "adminManageVehicle.php";
        </script>
<?php
    }
} else {

    header("Location: adminIndex.php");
    exit();
}

?>