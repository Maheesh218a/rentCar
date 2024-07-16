<?php
include "connection.php";
session_start();

$user = $_SESSION["u"];
$netTotal = 0;

if (!isset($_SESSION["u"]["id"])) {
    die("Please Sign in to add to cart");
}

$rs = Database::search("SELECT * FROM `cart` INNER JOIN `vehicle` ON `cart`.`vehicle_id` = `vehicle`.`id`
INNER JOIN `color` ON `vehicle`.`color_id` = `color`.`color_id`
INNER JOIN `vehicle_img` ON `vehicle`.`id` = `vehicle_img`.`vehicle_id`
WHERE `cart`.`users_id` = '" . $user["id"] . "' ");

$num2 = $rs->num_rows;
$num = $rs->num_rows;
$rs->num_rows;

if ($num > 0) {
    // Calculate total number of items in the cart
    $totalItems = 0;
    while ($cartItem = $rs->fetch_assoc()) {
        $totalItems += $cartItem["qty"];
    }
?>
    <div class="row mt-5 mb-4">
        <!-- Load Vehicle -->
        <?php
        $prev_vehicle_id = null;

        ?> <div class="col-md-12 mb-4 singleView">
            <div class="card">
                <div class="card-header py-3">
                    <h4 class="mb-0 fw-bold"> LOTUS<span style="color: darkgoldenrod;"> RENTCAR</span> - Vehicle Cart</h4>
                </div>

                <?php
                $rs->data_seek(0); // Reset result set pointer to fetch again
                while ($d = $rs->fetch_assoc()) {
                    $total = $d["price"] * $d["cart_qty"];
                    $netTotal = $total;

                    // Check if current vehicle ID is different from the previous one
                    if ($d["vehicle_id"] !== $prev_vehicle_id) {
                ?>

                        <div class="card-body">
                            <div class="row cartView d-flex align-items-center">
                                <div class="col-lg-2 col-md-3">
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                        <img src="<?php echo $d["img_path"] ?>" class="w-100" alt="TVS Victor" />
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4">
                                    <p><strong><?php echo $d["title"] ?></strong></p>
                                    <dt>Color:</dt>
                                    <dd><?php echo $d["color_name"] ?></dd>
                                    <dt>Available Qty:</dt>
                                    <dd><?php echo $d["qty"] ?></dd>
                                </div>

                                <div class="col-lg-3 col-md-2 d-flex justify-content-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-outline-success btn-sm" onclick="decrementCartQty(<?php echo $d['cart_id'] ?>);">-</button>
                                        <input type="number" id="qty<?php echo $d['cart_id'] ?>" class="form-control form-control-sm text-center border border-black" style="max-width: 50px;" value="<?php echo $d["cart_qty"] ?>" disabled>
                                        <button class="btn btn-outline-success btn-sm" onclick="incrementCartQty(<?php echo $d['cart_id'] ?>);">+</button>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="d-flex align-items-center">
                                        <h4 class="fw-bold">Total Cost: <span class="text-warning">Rs.<?php echo $total ?>.00</span></h4>
                                    </div>
                                </div>

                                <div class="col-lg-1 col-md-12 text-center">
                                    <button class="btn btn-danger btn-sm" onclick="removeCart('<?php echo $d['cart_id'] ?>');">X</button>
                                </div>
                                <div class="container">
                                    <h6 class="fw-bold">You Selected date <span class="text-secondary">2022.12.55</span> </h6>
                                </div>
                            </div>
                        </div>
                        <?php
                        // Update the previous vehicle ID
                        $prev_vehicle_id = $d["vehicle_id"];
                    }
                } ?>
            </div>
        </div>

        <!-- Approved Payment Methods -->
        <div class="col-md-6">
            <div class="row cartView">
                <div class="col-12">
                    <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-3"><img src="resources/payment_method/visa_img.png"></div>
                        <div class="col-3"><img src="resources/payment_method/mastercard_img.png"></div>
                        <div class="col-3"><img src="resources/payment_method/paypal_img.png"></div>
                        <div class="col-3"><img src="resources/payment_method/american_express_img.png"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-md-6">
            <div class="card mb-4 singleView">
                <div class="card-header py-3">
                    <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Total Amount
                            <span><?php echo $num ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Tax Fee (7%)
                            <span>Rs.150.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total amount</strong>
                                <strong>
                                    <p class="mb-0">(including VAT)</p>
                                </strong>
                            </div>
                            <span><strong>Rs.<?php echo $netTotal ?>.00</strong></span>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="checkOut();">
                        Go to checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-12 text-center mt-5">
        <h2>Your Cart is Empty</h2>
        <a href="index.php"><button class="btn btn-outline-primary">Start Shopping</button></a>
    </div>
<?php } ?>
