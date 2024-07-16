<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="adminStyle.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Add New Vehicle</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body">

        <?php require "adminHeader.php" ?>

        <!-- Modal -->
        <?php include "adminModal.php" ?>
        <!-- Modal -->

        <br class="mt-2">
        <div class="container my-5">
            <div class="card mt-6 shadow-6-strong">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Add New Vehicle</h5>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label" for="category">Select Vehicle Category</label>
                                <select class="form-select" id="category">
                                    <option value="0">Select Category</option>
                                    <?php

                                    $category_rs = Database::search("SELECT * FROM `category`");
                                    $category_num = $category_rs->num_rows;

                                    for ($i = 0; $i < $category_num; $i++) {
                                        $category_data = $category_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                                <div class="mt-2">
                                    <a href="adminAddNewCat.php">
                                        <button type="button" class="btn btn-outline-light btn-sm mt-2">Add New Category</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="brand">Select Vehicle Brand</label>
                                <select class="form-select" id="brand">
                                    <option value="0">Select Brand</option>
                                    <?php

                                    $brand_rs = Database::search("SELECT * FROM `brand`");
                                    $brand_num = $brand_rs->num_rows;

                                    for ($i = 0; $i < $brand_num; $i++) {
                                        $brand_data = $brand_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                                <div class="mt-2">
                                    <a href="adminAddNewCat.php">
                                        <button type="button" class="btn btn-outline-light btn-sm mt-2">Add New Brand</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="color">Select Vehicle Color</label>
                                <select class="form-select" id="color">
                                    <option value="0">Select Color</option>
                                    <?php

                                    $color_rs = Database::search("SELECT * FROM `color`");
                                    $color_num = $color_rs->num_rows;

                                    for ($i = 0; $i < $color_num; $i++) {
                                        $color_data = $color_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $color_data["color_id"]; ?>"><?php echo $color_data["color_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                                <div class="mt-2">
                                    <a href="adminAddNewCat.php">
                                        <button type="button" class="btn btn-outline-light btn-sm mt-2">Add New Color</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label" for="seat">Select Vehicle Number of Seats</label>
                                <select class="form-select" id="seat">
                                    <option value="0">Select Seats</option>
                                    <?php

                                    $seat_rs = Database::search("SELECT * FROM `seats`  ORDER BY `seats`.`seat_numbers` ASC");
                                    $seat_num = $seat_rs->num_rows;

                                    for ($i = 0; $i < $seat_num; $i++) {
                                        $seat_data = $seat_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $seat_data["seats_id"]; ?>"><?php echo $seat_data["seat_numbers"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                                <div class="mt-2">
                                    <a href="adminAddNewCat.php">
                                        <button type="button" class="btn btn-outline-light btn-sm mt-2">Add New Seat Numbers</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6  mt-3">
                                <label class="form-label" for="district">Select District (Vehicle Situated District)</label>
                                <select class="form-select" id="district">
                                    <option value="0">Select District</option>
                                    <?php

                                    $district_rs = Database::search("SELECT * FROM `district`  ORDER BY `district`.`district_name` ASC");
                                    $district_num = $district_rs->num_rows;

                                    for ($i = 0; $i < $district_num; $i++) {
                                        $district_data = $district_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $district_data["district_id"]; ?>"><?php echo $district_data["district_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 mb-3 mt-3">
                                    <label class="form-label" for="myear">Vehicle Manufacturer Year</label>
                                    <input type="text" class="form-control" id="myear" placeholder="Enter Vehicle Manufacturer Year">
                                </div>
                                <div class="col-lg-6 mb-3 mt-3">
                                    <label class="form-label" for="ryear">Vehicle Register Year</label>
                                    <input type="text" class="form-control" id="ryear" placeholder="Enter Product Title">
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">Vehicle Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter Vehicle Title">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="condition">Select Product Condition</label>
                                <select class="form-select" id="condition">
                                    <option value="0">Select Condition</option>
                                    <?php

                                    $condition_rs = Database::search("SELECT * FROM `condition`");
                                    $condition_num = $condition_rs->num_rows;

                                    for ($i = 0; $i < $condition_num; $i++) {
                                        $condition_data = $condition_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="contact">Add Your Contact Number</label>
                                <input type="text" class="form-control" id="contact" placeholder="Enter Your Contact Number">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 mt-2">
                                <label class="form-label" for="qty">Add Vehicle Quantity</label>
                                <input type="number" class="form-control" value="1" min="1" id="qty" placeholder="0">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-label" for="cost">Cost Per Item (Rs.)</label>
                                <input type="number" class="form-control" min="1" id="cost" placeholder="This Cost for one day price">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="desc">Vehicle Description</label>
                            <textarea class="form-control" id="desc" rows="5" placeholder="Enter product description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Add Vehicle Images</label><br>
                            <small>Please select all images at once.</small>
                            <div class="d-flex flex-wrap">
                                <div class="p-2">
                                    <input type="file" class="form-control-file" id="file1" onchange="fileSelect(event,1)"><br>
                                    <img src="resources/logo/upload.png" class="img-fluid d-none" style="width: 200px;" id="vehicleImage1" />
                                </div>
                                <div class="p-2">
                                    <input type="file" class="form-control-file" id="file2" onchange="fileSelect(event,2)"><br>
                                    <img src="resources/logo/upload.png" class="img-fluid d-none" style="width: 200px;" id="vehicleImage2" />
                                </div>
                                <div class="p-2">
                                    <input type="file" class="form-control-file" id="file3" onchange="fileSelect(event,3)"><br>
                                    <img src="resources/logo/upload.png" class="img-fluid d-none" style="width: 200px;" id="vehicleImage3" />
                                </div>
                                <div class="p-2">
                                    <input type="file" class="form-control-file" id="file4" onchange="fileSelect(event,4)"><br>
                                    <img src="resources/logo/upload.png" class="img-fluid d-none" style="width: 200px;" id="vehicleImage4" />
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-outline-info" onclick="addNewVehicle();">Save Vehicle</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include "adminFooter.php"; ?>
        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>

    </html>

    <script>

    </script>

<?php } else {
    header("Location:adminIndex.php");
} ?>