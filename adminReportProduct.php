<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    $rs =  Database::search("SELECT * FROM `vehicle` INNER JOIN `brand` ON `vehicle`.`brand_id` = `brand`. `brand_id` 
    INNER JOIN `color` ON `vehicle`.`color_id` = `color`.`color_id`
    INNER JOIN `category` ON `vehicle`.`cat_id` = `category`.cat_id
    INNER JOIN `seats` ON `vehicle`.`seats_id` = `seats`.`seats_id`
    INNER JOIN `vehicle_img` ON `vehicle_img`.`vehicle_id` = `vehicle`.`id`
    ORDER BY `vehicle`.`id` ASC");
    $num =  $rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOTUS Selling - vehicles Reports</title>
        <link rel="icon" href="Resources/icon.ico">
    </head>

    <body>

        <div class="container mt-3">
            <a href="adminReport.php"> <img src="Resources/image/icon.png" height="35" /></a>
        </div>

        <div class="container mt-3">
            <h2 class="text-center fw-bold">Products Report</h2>

            <table class="table table-hover mt-5">

                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>Category</th>
                        <th>Color</th>
                        <th>Seat Numbers</th>
                        <th>Description</th>
                        <th>Image</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    for ($i = 0; $i < $num; $i++) {
                        $d = $rs->fetch_assoc(); ?>
                        <tr>
                            <td><?php echo $d["id"]; ?></td>
                            <td><?php echo $d["title"]; ?></td>
                            <td><?php echo $d["brand_name"]; ?></td>
                            <td><?php echo $d["cat_name"]; ?></td>
                            <td><?php echo $d["color_name"]; ?></td>
                            <td><?php echo $d["seat_numbers"]; ?></td>
                            <td><?php echo $d["description"]; ?></td>
                            <td><img src="<?php echo $d["img_path"]; ?>" height="100"></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-outline-warning col-2" onclick="window.print();">Print</button>
        </div>



        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

} else {
   header("location:adminIndex.php");
}

?>