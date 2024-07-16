<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Lotus Selling Car</title>
    <link rel="icon" href="resources/logo/lotus.webp">
</head>

<body style="background-color: #ffffd1;">
    <?php include "header.php"; ?> <br>

    <div class="overlay"></div><br>
    <!-- Basic search -->
    <div class="row justify-content-center align-items-center mt-5">
        <div class="col-4 col-lg-1 logo" style="height: 65px;"></div>
        <div class="col-lg-6 col-md-8 col-12">
            <div class="input-group mb-3 form-outline">
                <input type="text" class="form-control rounded-pill py-2 px-4" id="kw" aria-label="Text input with dropdown button" placeholder="Search Vehicle Name" onkeyup="basicSearch(0);">
                <select class="form-select rounded-pill ms-2 py-2 px-4" id="c" style="max-width: 155px;">
                    <option value="0" class="rounded-pill">All Categories</option>
                    <?php
                    include "connection.php";
                    $category_rs = Database::search("SELECT * FROM `category`");
                    while ($category_data = $category_rs->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $category_data["cat_id"] ?>">
                            <?php echo $category_data["cat_name"] ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="input-group-append ms-2">
                    <button type="button" class="btn btn-outline-dark col-12 rounded-pill shadow-sm" onclick="basicSearch(0);">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 mt-lg-0 mt-3 d-flex justify-content-center">
            <a href="advancedSearch.php" class="btn btn-outline-primary">Advanced Search</a>
        </div>
    </div>
    <!-- Basic search -->


    <div class="container-fluid">
        <div class="row">
            <div class="hero-wrap" style="background-image: url('resources/background/image_4.jpg');">


                <div class="row no-gutters slider-text justify-content-start align-items-center">
                    <div class="col-lg-6 col-md-6 d-flex align-items-end">
                        <div class="text offset-1 mt-5">
                            <h1 class="mb-4">Now <span>It's easy for you</span> <span>buy a car</span></h1>
                            <p style="font-size: 18px;"></p>
                            <a href="help.php" class="icon-wrap popup-vimeo d-flex align-items-center mt-4">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <i class="bi bi-arrow-right fw-bold" style="color: white; size: 125px;"></i>
                                </div>
                                <div class="heading-title ml-5">
                                    <span>Easy steps for renting a car</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col"></div>
                </div>
            </div>
        </div>
        <hr>

        <div class="container my-5" id="basicSearchResult">
            <div class="row d-flex justify-content-center" id="pid">
                <u class="fw-bold">
                    <h2 class="vehicle text-center">Featured <b>Vehicles</b></h2>
                </u>

                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $items_per_page = 4;
                $offset = ($page - 1) * $items_per_page;

                // Retrieve vehicles based on the selected category ID
                $category_id = isset($_GET['category']) ? $_GET['category'] : 0;
                if ($category_id != 0) {
                    $vehicle_query = "SELECT * FROM `vehicle` 
                                    INNER JOIN `status` ON `vehicle`.status_id = `status`.status_id
                                    INNER JOIN `condition` ON `vehicle`.condition_id = `condition`.condition_id 
                                    WHERE `vehicle`.status_id='1' AND `vehicle`.category_id='$category_id'
                                    ORDER BY `datetime_added` DESC 
                                    LIMIT $items_per_page OFFSET $offset";
                } else {
                    $vehicle_query = "SELECT * FROM `vehicle` 
                                    INNER JOIN `status` ON `vehicle`.status_id = `status`.status_id
                                    INNER JOIN `condition` ON `vehicle`.condition_id = `condition`.condition_id 
                                    WHERE `vehicle`.status_id='1' AND `vehicle`.qty !='0'
                                    ORDER BY `datetime_added` DESC 
                                    LIMIT $items_per_page OFFSET $offset";
                }

                $product_rs = Database::search($vehicle_query);
                $product_num = $product_rs->num_rows;

                $total_rs = Database::search("SELECT COUNT(*) AS total FROM `vehicle` WHERE `status_id`='1'");
                $total_data = $total_rs->fetch_assoc();
                $total_items = $total_data['total'];
                $total_pages = ceil($total_items / $items_per_page);

                for ($x = 0; $x < $product_num; $x++) {
                    $product_data = $product_rs->fetch_assoc();
                    if ($product_data) {
                ?>
                        <div class="col-md-3 col-sm-6 mb-4 mt-4">
                            <div class="card">
                                <a href="<?php echo "singleVehicleView.php?id=" . ($product_data["id"]); ?>" class="">
                                    <?php
                                    $img_rs = Database::search("SELECT * FROM `vehicle_img` WHERE `vehicle_id`='" . $product_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $img_data["img_path"] ?>" class="card-img-top" alt="<?php echo $product_data["title"] ?>">
                                </a>
                                <div class="card-body text-center">
                                    <a href="<?php echo "singleVehicleView.php?id=" . ($product_data["id"]); ?>" class="">
                                        <h4 class="card-title"><?php echo $product_data["title"] ?></h4>
                                    </a>
                                    <p class="text-muted">Rs.<?php echo $product_data["price"] ?>.00</p>
                                    <a class="btn btn-outline-primary btn-sm" href="singleVehicleView.php?id=<?php echo $product_data["id"]; ?>" data-abc="true">View Vehicle</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <nav aria-label="Page navigation example" class="w-100">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?><?php if ($category_id != 0) echo '&category=' . $category_id; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>

            <!-- Service -->
            <div class="col-12" id="basicSearchResult">
                <div class="row">
                    <section>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12 heading-section text-center mb-5">
                                    <hr>
                                    <span class="subheading">Our Services</span>
                                    <h2 class="mb-2">Our Services</h2>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="col-md-3 d-flex align-self-stretch">
                                    <div class="media block-6 services">
                                        <div class="media-body py-md-4">
                                            <div class="d-flex mb-3 align-items-center">
                                                <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                                                <h3 class="heading mb-0 pl-3">24/7 Car Support</h3>
                                            </div>
                                            <p>Our dedicated team ensures assistance whenever you need it, ensuring a worry-free rental experience.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-self-stretch">
                                    <div class="media block-6 services">
                                        <div class="media-body py-md-4">
                                            <div class="d-flex mb-3 align-items-center">
                                                <div class="icon"><i class="bi bi-pin-map"></i></div>
                                                <h3 class="heading mb-0 pl-3">Lots of locations</h3>
                                            </div>
                                            <p>With numerous convenient spots, find us easily wherever your journey takes you for seamless rentals.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-self-stretch">
                                    <div class="media block-6 services">
                                        <div class="media-body py-md-4">
                                            <div class="d-flex mb-3 align-items-center">
                                                <div class="icon"><i class="bi bi-journal-medical"></i></div>
                                                <h3 class="heading mb-0 pl-3">Reservation</h3>
                                            </div>
                                            <p>Book your vehicle hassle-free with our simple reservation process, ensuring a smooth start to your journey.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-self-stretch">
                                    <div class="media block-6 services">
                                        <div class="media-body py-md-4">
                                            <div class="d-flex mb-3 align-items-center">
                                                <div class="icon"><i class="bi bi-car-front-fill"></i></div>
                                                <h3 class="heading mb-0 pl-3">Rental Cars</h3>
                                            </div>
                                            <p>Choose from our diverse selection of vehicles, ensuring the perfect ride for every occasion and preference.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- Service -->

            <hr>
            <!-- Reviews -->
            <section>
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-7 text-center heading-section">
                            <span class="subheading">Testimonial</span>
                            <h2 class="mb-3">Happy Clients</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel-testimony owl-carousel">
                                <div class="item">
                                    <div class="testimony-wrap text-center py-4 pb-5">
                                        <div class="user-img mb-4" style="background-image: url(resources/persons/person_1.jpg)"></div>
                                        <div class="text pt-4">
                                            <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more testimonials here -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Reviews -->
            <hr>
            <hr>
            <!-- Search Vehicle -->
            <section class="m-3">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(resources/cars/bg_1.jpg);"></div>
                        <div class="col-md-6 wrap-about py-md-5" style="background-color: #804674;">
                            <div class="heading-section mb-5 pl-md-5">
                                <span class="subheading text-center">Cars</span>
                                <h2 class="mb-4 text-center">Choose A Perfect Car</h2>
                                <p style="color: #ffffd1;">
                                    Choosing the perfect car for your journey is paramount, and at Lotus Selling Car, we understand the significance of finding the ideal match. Whether you're embarking on a solo adventure, a family road trip, or a group excursion, our diverse fleet caters to all needs and preferences.
                                </p>
                                <p style="color: #ffffd1;">
                                    At Lotus Selling Car, we prioritize customer satisfaction, and our knowledgeable team is here to assist you in selecting the perfect car for your specific requirements. Whether you prioritize fuel efficiency, luxury, or versatility, we have the right vehicle to enhance your travel experience. With easy reservation options and competitive rates, your journey begins with us. Choose Lotus Selling Car for a seamless rental experience and hit the road with confidence, knowing you've selected the perfect car for your adventure.
                                </p>
                                <p><a href="vehicles.php" class="btn btn-primary">See Vehicles</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Search Vehicle -->
            <hr>
            <hr>
            <!-- Blogs -->

            <?php $blog_rs = Database::search("SELECT * FROM `blogs`");
            $blog_num = $blog_rs->num_rows; ?>


            <section>
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-7 heading-section text-center">
                            <span class="subheading">Blog</span>
                            <h2>Recent Blog</h2>
                        </div>
                    </div>
                    <?php if (isset($_GET["page"])) {
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

                        <div class="row d-flex">
                            <div class="col-md-4 d-flex">
                                <div class="blog-entry justify-content-end">
                                    <a href="singleBlogView.php?s=<?php echo $selected_data["id"] ?>" class="block-20" style="background-image: url('<?php echo $blog_data["img_path"] ?>');"></a>
                                    <div class="text pt-4">
                                        <div class="meta mb-3">
                                            <div><a href="#" class="text-black"><?php echo $blog_data["date_addon"] ?></a></div>
                                            <div><a href="#" class="text-black"><?php echo $blog_data["author"] ?></a></div>

                                        </div>
                                        <a href="singleBlogView.php?s=<?php echo $selected_data["id"] ?>">
                                            <h3 class="heading mt-2"><?php echo $blog_data["title"] ?></h3>
                                        </a>
                                        <p><?php echo $blog_data["small_description"] ?><a href="singleBlogView.php?s=<?php echo $selected_data["id"] ?>">See More....</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more blog entries here -->
                        </div>
                    <?php }
                    ?>
                </div>
            </section>
            <!-- Blogs -->



        </div>
    </div>
    <?php include "footer.php" ?>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>