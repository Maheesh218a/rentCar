<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $vid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `vehicle` INNER JOIN `category` ON vehicle.cat_id = category.cat_id
    INNER JOIN `color` ON vehicle.color_id = color.color_id
    INNER JOIN `status` ON vehicle.status_id = status.status_id
    INNER JOIN `seats` ON vehicle.seats_id = seats.seats_id
    INNER JOIN `brand` ON vehicle.brand_id = brand.brand_id
    INNER JOIN `condition` ON vehicle.condition_id = condition.condition_id
    INNER JOIN `district` ON vehicle.district_id = district.district_id
    WHERE vehicle.id='" . $vid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();
?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title><?php echo $product_data["title"]; ?> Vehicle</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="mdb.min.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
            <link rel="icon" href="resources/logo/lotus.webp">

            <style>
                @media (max-width: 576px) {
                    .product .row dt {
                        flex: 0 0 40%;
                        max-width: 40%;
                    }

                    .product .row dd {
                        flex: 0 0 60%;
                        max-width: 60%;
                    }
                }
            </style>
        </head>

        <body style="background-color: #ffffd1;">
            <?php require "header.php"; ?>
            <br>
            <div>
                <div class="container mb-5">
                    <div class="ms-2 mt-5 col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h5 class="fw-bold ms-1 mt-1"><?php echo $product_data["title"]; ?></h5>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card singleView">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="images p-3">
                                            <div class="text-center p-4">

                                                <aside class="col-lg-6">

                                                    <?php

                                                    $vimg_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $vid . "'");
                                                    $vimg_num = $vimg_rs->num_rows;

                                                    ?>

                                                    <div class="border rounded-4 mb-3 d-flex justify-content-center offset-5">
                                                        <?php
                                                        if ($vimg_num != 0) {
                                                            $vimg_data = $vimg_rs->fetch_assoc();
                                                            $first_img_path = $vimg_data["img_path"];
                                                        ?>
                                                            <img style="max-width: 300%; max-height: 300vh; margin: auto;" class="rounded-4 fit " src="<?php echo $first_img_path; ?>" id="product-image" />
                                                        <?php
                                                        } else {
                                                            $first_img_path = "resources/logo/empty.svg";
                                                        ?>
                                                            <img style="max-width: 100%; max-height: 1000vh; margin: auto;" class="rounded-4 fit max-width: 100%; max-height: 100vh; margin: auto;" src="<?php echo $first_img_path; ?>" id="product-image" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="d-flex justify-content-center mb-3">

                                                        <?php

                                                        $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $vid . "'");
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
                                                            <img class="border mx-1 rounded-2  img-thumbnail thumbnail" src="resources/logo/empty.svg" onclick="changeImage('resources/logo/empty.svg')" />
                                                            <img class="border mx-1 rounded-2  img-thumbnail thumbnail" src="resources/logo/empty.svg" onclick="changeImage('resources/logo/empty.svg')" />
                                                        <?php
                                                        }

                                                        ?>

                                                    </div>

                                                </aside>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product p-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <a href="index.php">
                                                        <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-3">
                                                <span class="text-uppercase text-muted brand"><?php echo $product_data["brand_name"] ?></span>
                                                <h2 class="title text-dark fw-bold"><?php echo $product_data["title"] ?></h2>
                                                <h4 class="title text-dark fw-bold">Price for one day: Rs.<?php echo $product_data["price"] ?>.00</h4>
                                                <div class="row">
                                                    <dt class="col-4">Type:</dt>
                                                    <dd class="col-8"><?php echo $product_data["cat_name"] ?></dd>
                                                    <dt class="col-4">Color</dt>
                                                    <dd class="col-8"><?php echo $product_data["color_name"] ?></dd>
                                                    <dt class="col-4">Condition</dt>
                                                    <dd class="col-8"><?php echo $product_data["condition_name"] ?></dd>
                                                    <dt class="col-4">Seats No</dt>
                                                    <dd class="col-8"><?php echo $product_data["seat_numbers"] ?></dd>
                                                    <dt class="col-4">Available Qty</dt>
                                                    <dd class="col-8"><?php echo $product_data["qty"] ?></dd>
                                                </div>

                                                <div class="row mt-2 mb-4">
                                                    <div class="col-md-12 col-12 mb-3">
                                                        <label class="mb-2 d-block">Select You Want Quantity of Vehicle</label>
                                                        <div class="col-4">
                                                            <input type="text" placeholder="Qty" class="form-control" id="qty">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-5 me-1 cart mt-4 align-items-center singleView">
                                                    <label class="mb-2 d-block">Do you want purchase another vehicles</label>
                                                    <button class=" btn btn-info text-uppercase mr-2 px-4 rounded-3" onclick="addtoCart('<?php echo $product_data['id'] ?>');">Add to cart</button>
                                                </div>
                                                <div class="col-5 cart mt-4 align-items-center singleView ms-1">
                                                    <label class="mb-2 d-block">Do you want purchase only this vehicle</label>
                                                    <button class=" btn btn-warning text-uppercase mr-2 px-4 rounded-3" onclick="buyNow('<?php echo $product_data['id'] ?>');">Purchase Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-lg-8">

                                    <section class="bg-light border-top py-4 singleView">
                                        <div class="container">
                                            <div class="row gx-4">
                                                <div class="col-lg-12 mb-4">
                                                    <div class="border rounded-2 px-3 py-2 bg-white">
                                                        <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active rounded-pill shadow bg-secondary-subtle text-black border border-4">Description</button>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content bg-secondary-subtle p-2 rounded-3">
                                                            <textarea readonly class="form-control" id="desc" rows="8" placeholder=""><?php echo ($product_data["description"]); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                </div>
                                <div class="col-lg-4 mt-5 d-flex justify-content-end">
                                    <div class="px-0 border rounded-2 shadow-0">
                                        <div class="card singleView">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bolder">Similar products</h5>
                                                <div class="d-flex mt-3 p-1 bg-white rounded-3 border border-danger-subtle">

                                                    <?php
                                                    $vehicle_rs = Database::search("SELECT * FROM `vehicle` WHERE `cat_id`='" . $product_data['cat_id'] . "' AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");
                                                    $vehicle_num = $vehicle_rs->num_rows;

                                                    $simg_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $product_data['id'] . "'");
                                                    $simg_data = $simg_rs->fetch_assoc();

                                                    for ($x = 0; $x < $product_num; $x++) {
                                                        $vehicle_data = $vehicle_rs->fetch_assoc();

                                                    ?>
                                                        <a href="<?php echo "singleVehicleView.php?id=" . ($product_data["id"]); ?>" class="">
                                                            <img src="<?php echo $simg_data["img_path"]; ?>" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                                        </a>
                                                        <div class="info">

                                                            <a href="" <?php echo "singleVehicleView.php?id=" . ($product_data["id"]); ?> class="nav-link mb-1">
                                                                <?php echo $vehicle_data["title"] ?></br>
                                                                Available : <?php echo $vehicle_data["qty"] ?>
                                                            </a>
                                                            <strong class="text-dark">Rs. <?php echo $vehicle_data["price"] ?>.00</strong>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require "footer.php"; ?>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>

        </html>
    <?php } else { ?>
        <script>
            alert("Something went wrong");
        </script>

<?php }
} ?>