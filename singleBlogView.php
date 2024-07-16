<?php
include "connection.php";

$blog_id = $_GET["s"];


//echo($stockId);

if (isset($blog_id)) {

    $q = "SELECT * FROM `blogs` WHERE `blogs`.`id` = '" . $blog_id . "'";

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

    <body style="background-color: #ffffd1;">
        <?php require "header.php"; ?>
        <br class="mt-3">
<br class="mt-5">    
        <div class="col-8 row shadow-lg p-5 bg-body-tertiary rounded-3 m-auto mt-5 mb-5">


            <div class="row">
                <div class="mt-3 mb-2">
                    <img src="<?php echo $d["img_path"]; ?>" class="img-fluid rounded-start" width="500px" />
                </div>

            </div>




            <div class="col-12 mt-5 text-center">
                <h3 class="text-info">
                    <u>
                        <h1 class="fw-bold"><?php echo $d["title"] ?></h1>
                    </u>
                </h3>

                <div class="mt-3">
                    <h4 class="fw-bold">Author</h4>
                    <input type="text" readonly class="form-control" placeholder="<?php echo $d["author"] ?>">
                </div>

                <div class="mt-3">
                    <h4 class="fw-bold">Source Link</h4>
                    <a href="<?php echo $d["source_link"] ?>" target="_blank">
                        <input type="text" readonly class="form-control" placeholder="<?php echo $d["source_link"] ?>">
                    </a>
                </div>

                <div class="mt-3">
                    <h4 class="fw-bold">Date</h4>
                    <input type="text" readonly class="form-control" placeholder="<?php echo $d["date_addon"] ?>">
                </div>

                <div class="mt-3">
                    <h2 class="form-label fw-bold" for="desc">Vehicle Description (Small) </h2>
                    <textarea readonly class="form-control" id="desc" rows="4" placeholder=""><?php echo ($d["small_description"]); ?></textarea>
                </div>
                <div class="mt-3">
                    <h2 class="form-label fw-bold" for="desc">Vehicle Description </h2>
                    <textarea readonly class="form-control" id="desc" rows="8" placeholder=""><?php echo ($d["description"]); ?></textarea>
                </div>
            </div>

        </div>
        <br>
        <?php include "footer.php" ?>
        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>