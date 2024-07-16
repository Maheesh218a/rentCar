<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="CBody">
    <?php include "header.php"; ?> <br>
    <p class="breadcrumbs m-4"><span class="mr-2"><a href="index.php">Home <i class="bi bi-caret-right-fill"></i></a></span> <span>Contact us <i class="bi bi-caret-right-fill"></i></span></p>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('resources/background/bg_2.jpg'); background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-9 pb-5">
                    <h1 class="mb-3 bread text-white">Contact Us</h1>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <div class="container text-center mb-5">
        <h5 class="text-uppercase mb-4 fw-bold text-warning">Follow Us</h5>
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="https://web.facebook.com" target="_blank" class="text-decoration-none" style="color: blue;">
                    <i class="bi bi-facebook" style="font-size: 22px;"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://wa.me/+94767900101" target="_blank" class="text-decoration-none" style="color: green;">
                    <i class="bi bi-whatsapp" style="font-size: 22px;"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://twitter.com" target="_blank" class="text-decoration-none" style="color: #1DA1F2;">
                    <i class="bi bi-twitter" style="font-size: 22px;"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" class="text-decoration-none" style="color: red;">
                    <i class="bi bi-google" style="font-size: 22px;"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://www.linkedin.com/feed/" target="_blank" class="text-decoration-none" style="color: #0077B5;">
                    <i class="bi bi-linkedin" style="font-size: 22px;"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://www.youtube.com" target="_blank" class="text-decoration-none" style="color: red;">
                    <i class="bi bi-youtube" style="font-size: 22px;"></i>
                </a>
            </li>
        </ul>
    </div>
    <hr>

    <section class="contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 text-center py-4">
                            <div class="icon">
                                <i class="bi bi-map" style="font-size: 30px; color: #FFC107;"></i>
                            </div>
                            <p><span class="fw-bold">Address:</span> <br> Kirulagama, Palapathwala, Matale</p>
                        </div>
                        <div class="col-md-4 text-center py-4">
                            <div class="icon">
                                <i class="bi bi-phone" style="font-size: 30px; color: #FFC107;"></i>
                            </div>
                            <p><span class="fw-bold">Phone:</span> <br> <a href="tel:+94767900101" class="text-decoration-none" style="color: black;">+94 76 7900 101</a></p>
                        </div>
                        <div class="col-md-4 text-center py-4">
                            <div class="icon">
                                <i class="bi bi-envelope" style="font-size: 30px; color: #FFC107;"></i>
                            </div>
                            <p><span class="fw-bold">Email:</span> <br><a href="mailto:lotusvehicles@gmail.com" class="text-decoration-none" style="color: black;">lotusvehicles@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row block-9 justify-content-center mb-5">
                <div class="col-md-8 mb-md-5">
                    <h2 class="text-center">If you got any questions<br>please do not hesitate to send us a message</h2>
                    <form action="send_mail.php" method="post" class="bg-light p-5 contact-form">
                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="form-group mb-4">
                            <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Send Message" class="btn btn-outline-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php"; ?>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>
</html>