<?php
session_start();
$user = $_SESSION["u"];
include "connection.php";

if (isset($user)) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Order History</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body style="background-color: #ffffd1;">
        <?php include "header.php" ?>

        <section class="h-100" >
            <div class="container py-5 h-100" id="printArea">
                <div class="row d-flex justify-content-center align-items-center h-100">

                    <?php

                    $rs = Database::search("SELECT * FROM `order_history` WHERE `users_id` = '" . $user["id"] . "' ");
                    $num = $rs->num_rows;

                    if ($num > 0) {
                        $totalPaid = 0; // Initialize total paid variable
                    ?>


                        <div class="col-12 mt-5 mb-3 text-center">
                            <h3 class="fw-bold">ORDER HISTORY</h3>
                        </div>

                        <div class="col-lg-10 col-xl-8">
                            <!-- product view -->
                            <div class="card singleView">
                                <div class="card-header px-4 py-5">
                                    <h5 class="mb-0">Thanks for your Orders, <span style="color: #f9ca24;"><?php echo $user["fname"] ?></span>!</h5>
                                </div>

                                <?php

                                for ($i = 0; $i < $num; $i++) {
                                    $d = $rs->fetch_assoc();
                                    $totalPaid += $d["amount"]; // Add order amount to total paid
                                    ?>
                                    <div class="card shadow-0 border mb-4">
                                        <!-- Orders Items-->
                                        <div class="card-body cartView singleView">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <p class="mb-0 fw-bold">Order Date : <span class="col-12 text-danger text-end"><?php echo $d["order_date"] ?></span></p>
                                                <p class="mb-0 fw-bold">Receipt Voucher : <span class="text-danger"><?php echo $d["order_id"] ?></span></p>
                                            </div>

                                            <div class="row">

                                                <?php
                                                $rs2 = Database::search("SELECT * FROM order_items INNER JOIN `vehicle` ON order_items.`vehicle_id` = vehicle.`id`
                                                INNER JOIN vehicle_img ON vehicle.`id` = vehicle_img.`vehicle_id`
                                                INNER JOIN color ON vehicle.`color_id` = color.`color_id`
                                                WHERE order_items.`order_history_ohid` = '" . $d["ohid"] . "' ");

                                                $num2 = $rs2->num_rows;
                                                $d2 = $rs2->fetch_assoc();
                                                ?>

                                                <div class="col-md-2">
                                                    <img src="<?php echo $d2["img_path"] ?>" class="img-fluid" alt="Vehicle">
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0"><?php echo $d2["title"] ?></p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small"><?php echo $d2["color_name"] ?></p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">YOM: <?php echo $d2["year_made"] ?></p>
                                                    <p class="text-muted mb-0 small">ROM: <?php echo $d2["year_register"] ?></p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Qty: <?php echo $d2["oi_qty"] ?></p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Rs. <?php echo ($d2["price"] * $d2["oi_qty"]) ?>.00</p>
                                                </div>
                                            </div>
                                            <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                        </div>
                                        <!-- Orders Items-->
                                    </div>
                                <?php } ?>

                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between pt-2">
                                        <p class="fw-bold mb-0">Order Details</p>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="text-muted mb-0">Number of Vehicles bought by you: <?php echo $num ?></p>
                                    </div>
                                </div>
                                <div class="card-footer border-0 px-4 py-5">
                                    <h5 class="d-flex align-items-center justify-content-end text-monospace text-uppercase mb-0">Total
                                        paid: <span class="h2 mb-0 ms-2">Rs. <?php echo $totalPaid ?>.00</span></h5>
                                </div>
                            </div>
                            <!-- product view -->

                        <?php

                    } else { ?>
                            <!-- Empty -->
                            <div class="col-12 text-center mt-5">
                                <h2>You Have Not Placed Any Orders!!!</h2>
                                <a href="index.php"><button class="btn btn-outline-primary">Start Shopping</button></a>
                            </div>
                        <?php  }

                        ?>

                        </div>
                </div>
            </div>
        </section>
        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-danger col-2" onclick="printDiv();">Print Purchase History</button>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>

<?php } else {
    header("location: signIn.php");
}
?>
