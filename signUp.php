<!DOCTYPE html>
<html lang="en">

<head>

    <title>SignUp Page</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="signIn_body">
    <section class="h-100 gradient-form mt-3 mb-3">
        <div class="container py-5 h-100 signUp">
            <div class="row d-flex justify-content-center align-items-center h-100 ">
                <div class="col-xl-10 ">
                    <!--signup box-->
                    <div class="text-center">
                        <img src="resources/logo/lotus.webp" style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1" style="color: white;">We are The Lotus Team</h4>
                    </div>
                    <div class="col-12 col-lg-12 " id="SignUpBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02">Create New Account.</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="msg">

                                </div>
                            </div>
                            <div class="col-6">
                                <label></label>
                                <input class="form-control" type="text" placeholder="First Name" id="fname" />
                            </div>
                            <div class="col-6">
                                <label></label>
                                <input class="form-control" type="text" placeholder="Last Name" id="lname" />

                            </div>
                            <div class="col-6">
                                <label></label>
                                <input class="form-control" type="email" placeholder="Email Address" id="email" />
                            </div>

                            <div class="col-6">
                                <label></label>
                                <input class="form-control" type="password" placeholder="Password" id="password" />

                            </div>

                            <div class="col-6">
                                <label></label>
                                <input class="form-control" type="text" placeholder="Mobile Number" id="mobile" />

                            </div>
                            <div class="col-6">
                                <label></label>
                                <select class="form-control" id="gender">
                                    <option value="0">Select your Gender</option>
                                    <?php
                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>
                                </select>

                            </div><label></label>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-light" onclick="signUp();"> Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger"><a href="signIn.php" class="text-decoration-none">
                                        Sign In</button></a>
                            </div>

                        </div>
                    </div>
                    <!--signup box-->
                </div>
            </div>
        </div>
    </section>


    <script src="script.js"></script>
</body>

</html>