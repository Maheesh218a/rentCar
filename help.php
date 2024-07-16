<!DOCTYPE html>
<html lang="en">

<head>
    <title>Help & Work Flow</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .breadcrumbs {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .hero-wrap {
            background-position: center center;
            background-size: cover;
            height: 300px;
            position: relative;
        }

        .hero-wrap .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-wrap .container {
            position: relative;
            z-index: 2;
        }

        .hero-wrap h1 {
            color: white;
        }

        .heading-section span.subheading {
            font-size: 20px;
            display: block;
            margin-bottom: 10px;
        }

        .services {
            margin-bottom: 30px;
        }

        .services .icon {
            height: 100px;
            width: 100px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }

        .services .icon img {
            max-width: 60%;
        }

        .services h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .services p {
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php include "header.php"; ?>
    <br>
    <p class="breadcrumbs m-4">
        <span class="mr-2">
            <a href="index.php">Home <i class="fas fa-caret-right"></i></a>
        </span>
        <span>Help & Work Flow <i class="fas fa-caret-right"></i></span>
    </p>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('resources/background/bg_2.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-9 pb-5">
                    <h1 class="mb-3 bread">Help</h1>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <section class="img" style="background-image: url(resources/background/car-12.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section heading-section-white">
                    <span class="subheading bg-danger text-light py-1 px-3 rounded">Work flow</span>
                    <h2 class="mb-3 text-light">How it works</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 d-flex align-self-stretch">
                    <div class="media block-6 services services-2">
                        <div class="media-body py-md-4 text-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="resources/icons/world-map.png" alt="Pick Destination">
                            </div>
                            <h3 class="bg-info text-white py-2 px-3 rounded">Pick Destination</h3>
                            <p class="bg-black text-white py-2 px-3 rounded">Select your pickup place</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch">
                    <div class="media block-6 services services-2">
                        <div class="media-body py-md-4 text-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="resources/icons/car.png" alt="Select A Vehicle">
                            </div>
                            <h3 class="bg-info text-white py-2 px-3 rounded">Select A Vehicle</h3>
                            <p class="bg-black text-white py-2 px-3 rounded">Select car, van, bus, bike or lorry you want</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch">
                    <div class="media block-6 services services-2">
                        <div class="media-body py-md-4 text-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="resources/icons/payment-method.png" alt="Payment">
                            </div>
                            <h3 class="bg-info text-white py-2 px-3 rounded">Payment</h3>
                            <p class="bg-black text-white py-2 px-3 rounded">Paying for the reservation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch">
                    <div class="media block-6 services services-2">
                        <div class="media-body py-md-4 text-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="resources/icons/destination.png" alt="Enjoy The Ride">
                            </div>
                            <h3 class="bg-info text-white py-2 px-3 rounded">Enjoy The Ride</h3>
                            <p class="bg-black text-white py-2 px-3 rounded">Happy and safe journey</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <div class="col-12 text-center">
        <div class="col-lg-6 mx-auto">
            <a href="vehicle.php">
                <button class="btn btn-outline-dark mt-3 mb-3">See Vehicles</button>
            </a>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>