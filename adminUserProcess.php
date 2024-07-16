<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    $rs =  Database::search("SELECT * FROM `users` WHERE `email` != 'maheeshaudalagama@gmail.com'
    ORDER BY `users`.`id` ASC");
    $num =  $rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOTUS SELLING - User Reports</title>
        <link rel="icon" href="Resources/icon.ico">
    </head>

    <body>

        <div class="container mt-3">
            <a href="adminReport.php"> <img src="Resources/image/icon.png" height="35" /></a>
        </div>

        <div class="container mt-3">
            <h2 class="text-center fw-bold">User Report</h2>

            <table class="table table-hover mt-5">

                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Email</th>
                        <th>User Mobile Number</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    for ($i = 0; $i < $num; $i++) {
                        $d = $rs->fetch_assoc(); ?>
                        <tr>
                            <td><?php echo $d["id"]; ?></td>
                            <td><?php echo $d["fname"];?></td>
                            <td><?php echo $d["lname"];?></td>
                            <td><?php echo $d["email"]; ?></td>
                            <td><?php echo $d["mobile"]; ?></td>
                            <td><?php if ($d["status"] == 1) {
                                echo ("Active");
                            } else {
                                echo ("Deactive");
                            }
                             ?></td>
                        </tr>
                    <?php } ?>

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-outline-warning col-2" onclick="window.print();">Print</button>
        </div>

        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

} else {
    header("Location:adminIndex.php");
    exit();;
}

?>