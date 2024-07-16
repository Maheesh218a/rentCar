<?php
include "connection.php";

$vehicle_id = $_GET["s"];


//echo($stockId);

if (isset($vehicle_id)) {

    $q = "SELECT * FROM `vehicle` INNER JOIN `brand` ON `vehicle`.`brand_id` = `brand`.`brand_id`
    INNER JOIN `vehicle_img` ON `vehicle_img`.`vehicle_id` = `vehicle`.`id`
    INNER JOIN `color` ON `vehicle`.`color_id` = `color`.`color_id` 
    INNER JOIN `category` ON `vehicle`.`cat_id` = `category`.`cat_id`
    INNER JOIN `condition` ON `vehicle`.`condition_id` = `condition`.`condition_id`
    INNER JOIN `seats` ON `vehicle`.`seats_id` = `seats`.`seats_id`
    INNER JOIN `district` ON `vehicle`.`district_id` = `district`.`district_id` 
    WHERE `vehicle`.`id` = '" . $vehicle_id . "'";

    $rs = Database::search($q);
    $d = $rs->fetch_assoc();

?>


    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Vehicles</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body class="">
        <?php require "adminHeader.php"; ?>
        <br class="mt-5">
        <br class="mt-5">
        <div class="col-8 row shadow-lg p-5 bg-body-tertiary rounded-3 m-auto mt-5 mb-5">
            <aside class="col-lg-6">

                <?php

                $vimg_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $vehicle_id . "'");
                $vimg_num = $vimg_rs->num_rows;

                ?>

                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                    <?php
                    if ($vimg_num != 0) {
                        $vimg_data = $vimg_rs->fetch_assoc();
                        $first_img_path = $vimg_data["img_path"];
                    ?>
                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $first_img_path; ?>" id="product-image" />
                    <?php
                    } else {
                        $first_img_path = "resources/logo/empty.svg";
                    ?>
                        <img style="max-width: 100%; max-height: 200vh; margin: auto;" class="rounded-4 fit" src="<?php echo $first_img_path; ?>" id="product-image" />
                    <?php
                    }
                    ?>
                </div>

                <div class="d-flex justify-content-center mb-3">

                    <?php

                    $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $vehicle_id . "'");
                    $img_num = $img_rs->num_rows;
                    $img_list = array();

                    if ($img_num != 0) {
                        for ($x = 0; $x < $img_num; $x++) {
                            $img_data = $img_rs->fetch_assoc();
                            $img_path = $img_data["img_path"];
                    ?>

                            <img width="60" height="60" class="border mx-1 rounded-2 img-thumbnail thumbnail" src="<?php echo $img_path; ?>" onclick="changeImage('<?php echo $img_path; ?>')" />

                        <?php

                        }
                    } else {
                        ?>
                        <img width="60" height="60" class="border mx-1 rounded-2 img-thumbnail thumbnail" src="resources/logo/empty.svg" onclick="changeImage('resources/logo/empty.svg')" />
                        <img width="60" height="60" class="border mx-1 rounded-2 img-thumbnail thumbnail" src="resources/logo/empty.svg" onclick="changeImage('resources/logo/empty.svg')" />
                    <?php
                    }

                    ?>

                </div>

            </aside>

            <div class="col-6">
                <h3 class="text-info">
                    <p class="fw-bold"><?php echo $d["title"] ?></p>
                </h3>
                <h5 class="mt-3">Brand: <span class="fw-bold" style="color: green;"><?php echo $d["brand_name"] ?></span></h5>
                <h6 class="mt-3">Category: <span class="fw-bold" style="color: green;"><?php echo $d["cat_name"] ?></span></h6>
                <h6 class="mt-3">Color: <span class="fw-bold" style="color: green;"><?php echo $d["color_name"] ?></span></h6>
                <h6 class="mt-3">Vehicle Situated District:<span class="fw-bold" style="color: green;"> <?php echo $d["district_name"] ?></span></h6>
                <h6 class="mt-3">Number of Seats:<span class="fw-bold" style="color: green;"> <?php echo $d["seat_numbers"] ?></span></h6>
                <h6 class="mt-3">Condition:<span class="fw-bold" style="color: green;"> <?php echo $d["condition_name"] ?></span></h6>
                <div class="mt-3">
                    <label class="form-label" for="desc">Vehicle Description: </label>
                    <textarea readonly class="form-control" id="desc" rows="8" placeholder=""><?php echo ($d["description"]); ?></textarea>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <input type="text" placeholder="Qty" class="form-control">
                    </div>
                    <div class="col-6 mt-2">
                        <h6 class="text-warning">Available Quantity : <?php echo $d["qty"] ?></h6>
                    </div>
                </div>
                <h5 class="mt-3">Price : <?php echo $d["price"] ?>.00</h5>
            </div>

        </div>
        <br class="mt-5">

        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>