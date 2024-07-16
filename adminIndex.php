<!DOCTYPE html>
<html lang="en">

<head>

    <title>SignIn Page</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />


</head>

<body style="background-color: #4b4884;">

    <section class="h-100 gradient-form ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10 ">
                    <h1 class="text-center fw-bold bg-body-tertiary">ADMIN LOGIN</h1>
                    <!-- Signin Box -->
                    <div class="card rounded-3 text-black " id="SignInBox">
                        <div class="col-6 d-none d-lg-block background"></div>
                        <div class="row g-0 ">
                            <div class="col-lg-6 ">
                                <div class="card-body p-md-5 mx-md-4 ">

                                    <div class="text-center">
                                        <img src="resources/logo/lotus.webp" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                                    </div>

                                    <form onsubmit="signin(event)">
                                        <p class="text fw-bold">Please login to your account</p>

                                        <div class="col-12">
                                            <label class="form-label"></label>
                                            <input type="email" class="form-control" id="email2" placeholder="Username" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label"></label>
                                            <input type="password" class="form-control" id="password2" placeholder="Password" />
                                        </div><br>

                                        <div class="col-12  d-grid">
                                            <button class="btn btn-primary" onclick="signin();">Sign In</button>
                                        </div>


                                        <div class="col-12 text-start">
                                            <a href="forgotPassword.php" class="link-primary">Forgot Password?</a>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2  d-small-none">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="resources/logo/lotus.webp" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Lotus Team Admin Panel</h4>
                                    </div>
                                    <p class="small mb-0 text">Explore the road with Lotus Rent Car. From sleek cars to spacious vans and buses, we offer a diverse fleet for every journey.
                                        With competitive rates and top-notch service, trust us to make your rental experience smooth and memorable.
                                        Start your adventure today with Lotus Rent Car.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="adminScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    function signin(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        var email = document.getElementById("email2").value;
        var password = document.getElementById("password2").value;

        if (email.trim() === "") {
            alert("Please enter your Email Address.");
            return;
        }
        if (password.trim() === "") {
            alert("Please enter your Password.");
            return;
        }

        var f = new FormData();
        f.append("e", email);
        f.append("p", password);
        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4 && r.status == 200) {
                var t = r.responseText;
                if (t === "success") {
                    window.location = "adminHome.php";
                } else {
                    alert(t);
                }
            }
        };
        r.open("POST", "adminLogInProcess.php", true);
        r.send(f);
    }
</script>