<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    $pageno;

?>


    <!DOCTYPE html>

    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="adminStyle.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Blog Management</title>
        <link rel="icon" href="resources/logo/lotus.webp">

    </head>

    <body> <?php include "adminHeader.php"; 
    include "adminModal.php"; ?>
        <br>
        <nav aria-label="breadcrumb" class="mt-5 offset-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="adminManageBlogs.php">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Blogs</li>
            </ol>
        </nav>
        <div class="container py-5">
            <div class="row mx-2 mx-md-0">

                <!-- body -->
                <div class="">
                    <div class="row">
                        <!-- filter -->
                        <div class="col-12 rounded-4 card bg-body-tertiary">
                            <div class="row mb-3">
                                <div class="text-center col-8">
                                    <p class="mt-3 fs-1 fw-bold">Manage Blogs</p>
                                </div>
                                <a href="adminAddNewBlog.php">
                                    <button class="btn btn-warning justify-content-end col-4 rounded-5">Add New Blog</button>
                                </a>
                            </div>
                            <hr>
                            <div class="row mb-3 d-flex justify-content-end">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <input type="text" placeholder="Search..." class="form-control rounded-4" id="search">
                                </div>
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <select name="sort_select" class="form-select rounded-4" id="select">
                                        <option value="0">Sort by</option>
                                        <option value="1">Newest to oldest</option>
                                        <option value="2">Oldest to newest</option>
                                        <option value="3">Price high to low</option>
                                        <option value="4">Price low to high </option>
                                        <option value="5">Quantity high to low</option>
                                        <option value="6">Quantity low to high</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <select name="condition_select" class="form-select rounded-4" id="condition">
                                        <option value="0">Condition by</option>
                                        <?php

                                        $con_rs = Database::search("SELECT * FROM `condition`");
                                        $con_num = $con_rs->num_rows;

                                        for ($i = 0; $i < $con_num; $i++) {
                                            $con_data = $con_rs->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $con_data["condition_id"]; ?>"><?php echo $con_data["condition_name"]; ?></option>

                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1 mb-3 d-flex justify-content-end">
                                    <button class="btn btn-primary fw-bold rounded-4" onclick="filter(0);">Sort</button>
                                </div>
                            </div>

                        </div>
                        <!-- filter -->
                        <div class="mt-3 mb-3 card card-body rounded-4 container-fluid bg-body-tertiary">
                            <div class="row rounded-3" id="sort">


                            </div>
                        </div>

                        <!-- Vehicle -->
                        <div class="mt-3 mb-3 card card-body rounded-4 container-fluid bg-body-tertiary">
                            <div class="row rounded-3" id="sort">

                                <div class="text-center mt-3">
                                    <div class="row mx-2 mx-md-0 d-flex justify-content-center ">
                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $blog_rs = Database::search("SELECT * FROM `blogs`");
                                        $blog_num = $blog_rs->num_rows;

                                        $results_per_page = 4;
                                        $number_of_pages = ceil($blog_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `blogs` LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();
                                            $blog_data = $blog_rs->fetch_assoc();

                                        ?>
                                            <!-- card -->
                                            <div class="card col-md-4 mb-4 mx-3 rounded-4">
                                                <div class="row">
                                                    <div class="mt-3 mb-2">
                                                        <a href="singleBlogView.php?s=<?php echo $selected_data["id"] ?>">
                                                            <img src="<?php echo $blog_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold"> Title:
                                                            <a href="adminSingleBlogView.php?s=<?php echo $selected_data["id"] ?>">
                                                                <?php echo $selected_data["title"]; ?>
                                                            </a>
                                                        </h5>
                                                        <div class="form-check form-switch mt-3">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="author">Author Name of the Blog</label>
                                                                    <a href="<?php echo ($selected_data["source_link"]); ?>" target="_blank">
                                                                        <input readonly type="text" class="form-control" id="author" placeholder="<?php echo ($selected_data["author"]); ?>">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3">
                                                                <label class="form-label" for="desc">Blog Description (Small): </label>
                                                                <textarea readonly class="form-control" id="desc" rows="2" placeholder=""><?php echo ($selected_data["small_description"]); ?></textarea>
                                                            </div>
                                                            <div class="mt-3">
                                                                <label class="form-label" for="desc">Blog Description: </label>
                                                                <textarea readonly class="form-control" id="desc" rows="2" placeholder=""><?php echo ($selected_data["description"]); ?></textarea>
                                                            </div>
                                                            <input class="form-check-input fs-5 mt-3" type="checkbox" role="switch" id="<?php echo $selected_data["id"]; ?>" onchange="changeBlogStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                                            <label class="form-check-label fw-bold text-info mt-3" for="<?php echo $selected_data["id"]; ?>">
                                                                <?php if ($selected_data["status_id"] == 2) { ?>
                                                                    <p style="color: blue;">Activate This Blog</p>
                                                                <?php } else {
                                                                ?>
                                                                    <p style="color: red;">Deactivate This Blog</p>
                                                                <?php
                                                                } ?>
                                                            </label>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12">
                                                                <div class="row g-1">
                                                                    <div class="col-6  d-grid">
                                                                        <button class="btn btn-outline-success fw-bold" onclick="sendIdBlog(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                    </div>
                                                                    <div class="col-6  d-grid">
                                                                        <button class="btn btn-outline-danger fw-bold" onclick="confirmDeleteBlog(<?php echo $selected_data['id']; ?>);">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card -->
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- Pagination -->

                                <div class="col-8 col-lg-6 text-center mb-2 offset-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="ms-lg-3 pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>

                                            <?php

                                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                                if ($y == $pageno) {
                                            ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }

                                            ?>

                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <!-- Pagination -->
                            </div>
                        </div>
                    </div>

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-2">
                        <nav aria-label="Page navigation example">
                            <ul class="ms-lg-3 pagination pagination-lg justify-content-center">




                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Vehicle -->

        </div>
        </div>
        <!-- body -->

        </div>
        </div>

        <?php require "adminFooter.php"; ?>

        <script src="bootstrap.bundle.js"></script>
        <script src="adminScript.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
        <script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.8.1/js/mdb.min.js"></script>
    </body>

    </html>

<?php

} else {

    header("Location:adminIndex.php");
    exit();
}

?>