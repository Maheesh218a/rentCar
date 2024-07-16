<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_SESSION["b"])) {
        $blog = $_SESSION["b"];
?>

        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="bootstrap.css">
            <title>Blog Update</title>
            <link rel="icon" href="resources/logo/lotus.webp">
        </head>

        <body>
            <?php include "adminHeader.php";  ?>
            <br>

            <!-- Modal -->
            <div class="modal modalBody1" tabindex="-1" id="msgDiv1" onclick="reloadS();">
                <div class="modal-dialog">
                    <div class="modal-content" id="msg">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger fw-bold">Your are Sweet...</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body1">
                            <p class="fw-bold text-warning"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal" onclick="reload();">Ok</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

            <div class="modal modalBody2" tabindex="-1" id="msgDiv2">
                <div class="modal-dialog">
                    <div class="modal-content" id="msg">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger fw-bold">ooops!!! Something Went Wrong</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body2">
                            <p class="fw-bold text-warning"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->

            <div class="container my-5 mt-5">
                <div class="card mt-6 shadow-6-strong">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Update Blog</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Update Blog Title</label>
                                <input type="text" class="form-control" id="title" value="<?php echo ($blog["title"]); ?>" placeholder="Enter Vehicle title">
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="VehicleCondition" class="form-label">Current Blog image</label>
                                    <div class="row">
                                        <?php

                                        $img_rs = Database::search("SELECT * FROM `blogs` WHERE `id` = '" . $blog["id"] . "'");
                                        $img_num = $img_rs->num_rows;

                                        for ($i = 0; $i < $img_num; $i++) {
                                            $img_data = $img_rs->fetch_assoc();
                                        ?>

                                            <div class="col-6 col-md-3">
                                                <img src="<?php echo $img_data["img_path"] ?>" class="card-img-top">
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label" for="link">Source Link</label>
                                    <textarea class="form-control" id="link" rows="3" placeholder=""><?php echo ($blog["source_link"]); ?></textarea>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label" for="sdesc">Update Blog Description (Small)</label>
                                    <textarea class="form-control" id="sdesc" rows="3" placeholder=""><?php echo ($blog["small_description"]); ?></textarea>
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label" for="desc">Update Blog Description</label>
                                    <textarea class="form-control" id="desc" rows="5" placeholder=""><?php echo ($blog["description"]); ?></textarea>
                                </div>

                                <div class="">
                                    <label class="form-label">Update Blog Image</label><br>
                                    <small>Please select all images at once.</small>
                                    <div class="d-flex flex-wrap">
                                        <div class="p-2">
                                            <input type="file" class="form-control-file" id="file" onchange="fileSelect(event,1)"><br>
                                            <img src="resources/logo/upload.png" class="img-fluid d-none" style="width: 200px;" id="vehicleImage1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-info col-12" onclick="updateBlog();">Save Blog</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "adminFooter.php"; ?>

            <script src="adminScript.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
    <?php } else { ?>
        <script>
            alert("Please select a blog.");
            window.location = "adminManageVehicle.php";
        </script>
<?php
    }
} else {

    header("Location:adminIndex.php");
    exit();
}

?>