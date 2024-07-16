<?php
session_start();
include "connection.php";
$user = $_SESSION["u"];
$orderHistoryId = $_GET["orderId"];

$rs = Database::search("SELECT * FROM `order_history` WHERE `ohid` = '" . $orderHistoryId . "' ");
$num = $rs->num_rows;

if ($num > 0) {
    $d = $rs->fetch_assoc(); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <title>Invoice</title>
        <link rel="icon" href="resources/logo/lotus.webp">
        <style>
            body {
                background-color: #ffffd1;
                font-family: Arial, sans-serif;
            }

            .invoice {
                background: #fff;
                padding: 20px;
                margin: 20px auto;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }

            .invoice-header {
                margin-bottom: 20px;
            }

            .invoice-details {
                margin-bottom: 20px;
            }

            .invoice-footer {
                text-align: center;
                color: #777;
                border-top: 1px solid #aaa;
                padding-top: 10px;
                margin-top: 20px;
            }

            @media (max-width: 768px) {

                .invoice-header,
                .invoice-details {
                    text-align: center;
                }
            }

            @media (max-width: 480px) {

                .invoice-header h2,
                .invoice-details h1 {
                    font-size: 1.5em;
                }

                .table thead {
                    display: none;
                }

                .table tr {
                    margin-bottom: 10px;
                    display: block;
                    border-bottom: 2px solid #ddd;
                }

                .table td {
                    display: block;
                    text-align: right;
                    font-size: 0.8em;
                    border-bottom: 1px dotted #ccc;
                }

                .table td::before {
                    content: attr(data-label);
                    float: left;
                    font-weight: bold;
                }

                .table td:last-child {
                    border-bottom: 0;
                }
            }
        </style>
    </head>

    <body>

        <div class="container text-end mt-3">
            <a href="index.php"><button class="btn btn-outline-dark">HOME</button></a>
        </div>

        <div class="container">
            <div class="invoice">
                <div class="invoice-header row">
                    <div class="col-6">
                        <img src="resources/logo/lotus.webp" width="80" alt="Company Logo">
                    </div>
                    <div class="col-6 text-right">
                        <h2>LOTUS SELLING CAR</h2>
                        <div>Kirulagama, Palapthwala, Matale</div>
                        <div>+94 76 79 00 101</div>
                        <div>lotutsvehicles@gmail.com</div>
                    </div>
                </div>

                <div class="invoice-details row">
                    <div class="col-6">
                        <h1>Order ID #<?php echo $d["order_id"] ?></h1>
                        <div>Date of Invoice: <?php echo $d["order_date"] ?></div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $user["fname"] ?> <?php echo $user["lname"] ?></h2>
                        <div class="mobile"><?php echo $user["mobile"] ?></div>
                        <div class="email"><?php echo $user["email"] ?></div>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Vehicle Name</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Quantity Buy</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $rs2 = Database::search("SELECT * FROM `order_items` 
                        INNER JOIN `vehicle` ON `order_items`.`vehicle_id` = `vehicle`.`id`
                        INNER JOIN `brand` ON `vehicle`.`brand_id` = `brand`.`brand_id`
                        INNER JOIN `color` ON `vehicle`.`color_id` = `color`.`color_id`
                        INNER JOIN `category` ON `vehicle`.`cat_id` = `category`.`cat_id`
                        INNER JOIN `seats` ON `vehicle`.`seats_id` = `seats`.`seats_id`
                        WHERE `order_items`.`order_history_ohid` = '" . $orderHistoryId . "' ");

                        $num2 = $rs2->num_rows;
                        $grandTotal = 0;

                        for ($i = 0; $i < $num2; $i++) {
                            $d2 = $rs2->fetch_assoc();
                            $total = $d2["price"] * $d2["oi_qty"];
                            $grandTotal += $total;
                        ?>
                            <tr>
                                <td data-label="#"><?php echo $i + 1; ?></td>
                                <td data-label="Vehicle Name" class="text-left">
                                    <h3><?php echo $d2["title"] ?></h3>
                                    <?php echo $d2["color_name"] ?>, <?php echo $d2["cat_name"] ?>, number of seats - <?php echo $d2["seat_numbers"] ?>, YOM - <?php echo $d2["year_made"] ?>, YOR - <?php echo $d2["year_register"] ?>
                                </td>
                                <td data-label="Unit Price" class="text-right">Rs. <?php echo $d2["price"] ?>.00</td>
                                <td data-label="Quantity Buy" class="text-right"><?php echo $d2["oi_qty"] ?></td>
                                <td data-label="TOTAL" class="text-right">Rs. <?php echo $total ?>.00</td>
                            </tr>

                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td class="fw-bold">Rs. <?php echo $grandTotal ?>.00</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice text-danger">We are not accepting vehicles after you buy them from us</div>
                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

<?php
} else {
    header("location: index.php");
}
?>
