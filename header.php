<?php
// Start the session before any output is sent to the browser
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img class="me-3" src="Resources/logo/lotus.webp" height="25">
                Lotus<span style="color: darkgoldenrod;"> Selling Car</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex justify-content-end">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 text-sm-start mb-lg-0">
                        <li class="nav-item me-5"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item me-5"><a href="about.php" class="nav-link">About</a></li>
                        <li class="nav-item me-5"><a href="vehicle.php" class="nav-link">Vehicles</a></li>
                        <li class="nav-item me-5"><a href="blog.php" class="nav-link">Blog</a></li>
                        <li class="nav-item me-5"><a href="contact.php" class="nav-link">Contact</a></li>
                        <li class="nav-item me-4 mt-2">
                            <?php
                            if (isset($_SESSION["u"])) {
                                $data = $_SESSION["u"]; ?>
                                <a href="signIn.php" class="text-decoration-none fw-bold" onclick="signout();">Sign Out</a>

                        <li class="nav-item me-5"><a href="cart.php" class="nav-link">Cart</i></a></li>
                        <li class="nav-item me-5"><a href="orderHistory.php" class="nav-link">History</i></a></li>
                    <?php } else { ?>
                        <a href="signIn.php" class="text-decoration-none fw-bold">Sign In</a>
                    <?php } ?>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- nav bar -->

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>