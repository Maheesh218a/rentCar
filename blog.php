<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blogs</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="adminStyle.css">
    <link rel="icon" href="resources/logo/lotus.webp">
</head>

<body style="background-color: #ffffd1;">
    <!-- Header -->
    <?php include "adminHeader.php"; ?>
    <!-- Header -->

    <!-- Breadcrumb -->
      <br>
    <nav aria-label="breadcrumb" class="mt-5 offset-1">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Blogs</li>
        </ol>
    </nav>
    <!-- Breadcrumb -->

    <div class="container">
        <div class="row mx-2 mx-md-0">

            <!-- Blog Cards -->
            <div class="mt-3 mb-3 card card-body rounded-4 container-fluid bg-body-tertiary">
                <div class="row rounded-3" id="sort">
                    <!-- Dynamic content from database -->
                    <?php
                    // Loop through blog data and generate cards
                    include "connection.php";

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
                        <div class="card col-md-4 mb-4 mx-3 rounded-4 singleView"  style="background-color: lightblue;">
                            <div class="row">
                                <!-- Blog Image -->
                                <div class="mt-3 mb-2">
                                    <a href="singleBlogView.php?s=<?php echo $selected_data["id"] ?>">
                                        <img src="<?php echo $blog_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                    </a>
                                </div>
                            </div>
                            <!-- Blog Content -->
                            <div class="col-md-8" >
                                <div class="card-body">
                                    <!-- Blog Title -->
                                    <h5 class="card-title fw-bold"> Title:
                                        <a href="singleBlogView.php?s=<?php echo $selected_data["id"] ?>">
                                            <?php echo $selected_data["title"]; ?>
                                        </a>
                                    </h5>
                                    <!-- Blog Author -->
                                    <div class="form-check form-switch mt-3">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="author">Author Name of the Blog</label>
                                                <a href="<?php echo ($selected_data["source_link"]); ?>" target="_blank">
                                                    <input readonly type="text" class="form-control" id="author" placeholder="<?php echo ($selected_data["author"]); ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Blog Description -->
                                        <div class="mt-3">
                                            <label class="form-label" for="desc">Blog Description (Small): </label>
                                            <textarea readonly class="form-control" id="desc" rows="2" placeholder=""><?php echo ($selected_data["small_description"]); ?></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label" for="desc">Blog Description: </label>
                                            <textarea readonly class="form-control" id="desc" rows="2" placeholder=""><?php echo ($selected_data["description"]); ?></textarea>
                                        </div>
                                        <!-- Blog Status -->
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Blog Cards -->

            <!-- Pagination -->
            <div class="col-8 col-lg-6 text-center mb-2 offset-3">
                <nav aria-label="Page navigation example">
                    <ul class="ms-lg-3 pagination pagination-lg justify-content-center">
                        <!-- Pagination links -->
                        <?php
                        for ($y = 1; $y <= $number_of_pages; $y++) {
                            if ($y == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                </li>
                            <?php } else { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                </li>
                        <?php }
                        } ?>
                    </ul>
                </nav>
            </div>
            <!-- Pagination -->

        </div>
    </div>

    <!-- Footer -->
    <?php require "adminFooter.php"; ?>
    <!-- Footer -->

    <!-- Scripts -->
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
    <script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.8.1/js/mdb.min.js"></script>
    <!-- Scripts -->
</body>

</html>