<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Advanced Search - Lotus Selling Car</title>
    <link rel="icon" href="resources/logo/lotus.webp">
</head>

<body style="background-color: #ffffd1;">
    <?php include "header.php"; ?> <br>
    <br>
    <div class="container my-5  singleView" style="background-color: white;">
        <div class="row">
            <div class="col-12">
                <h2>Advanced Search</h2>
                <form id="advancedSearchForm">
                    <div class="mb-3">
                        <label for="text" class="form-label">Vehicle Name</label>
                        <input type="text" class="form-control" id="text" name="text">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="0">All Categories</option>
                            <?php
                            include "connection.php";
                            $category_rs = Database::search("SELECT * FROM `category`");
                            while ($category_data = $category_rs->fetch_assoc()) {
                                echo "<option value='{$category_data["cat_id"]}'>{$category_data["cat_name"]}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <select class="form-select" id="brand">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($i = 0; $i < $brand_num; $i++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand_data["brand_id"] ?>"><?php echo $brand_data["brand_name"] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <select class="form-select" id="district" name="district">
                            <option value="0">All Districts</option>
                            <?php
                            $district_rs = Database::search("SELECT * FROM `district`");
                            while ($district_data = $district_rs->fetch_assoc()) {
                                echo "<option value='{$district_data["id"]}'>{$district_data["name"]}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <select class="form-select" id="c2">
                            <option value="0">Select Condition</option>
                            <?php
                            $condition_rs = Database::search("SELECT * FROM `condition`");
                            $condition_num = $condition_rs->num_rows;

                            for ($i = 0; $i < $condition_num; $i++) {
                                $condition_data = $condition_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $condition_data["condition_id"] ?>"><?php echo $condition_data["condition_name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $color_rs = Database::search("SELECT * FROM `color`");
                                            $color_num = $color_rs->num_rows;

                                            for ($i = 0; $i < $color_num; $i++) {
                                                $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color_data["clr_id"] ?>"><?php echo $color_data["clr_name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pf" class="form-label">Price From</label>
                        <input type="number" class="form-control" id="pf" name="pf">
                    </div>
                    <div class="mb-3">
                        <label for="pt" class="form-label">Price To</label>
                        <input type="number" class="form-control" id="pt" name="pt">
                    </div>
                    <div class="mb-3">
                        <label for="sort" class="form-label">Sort By</label>
                        <select class="form-select" id="sort" name="sort">
                            <option value="0">Relevance</option>
                            <option value="1">Price: Low to High</option>
                            <option value="2">Price: High to Low</option>
                            <option value="3">Quantity: Low to High</option>
                            <option value="4">Quantity: High to Low</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-5" id="advancedSearchResult">
        <!-- Search results will be displayed here -->
    </div>

    <?php include "footer.php"; ?>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>