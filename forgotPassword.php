<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password Page</title>
    <link rel="icon" href="resources/logo/lotus.webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <style>

        .btn-custom {
            background-color: #17a2b8;
            color: #ffffff;
        }

        .btn-custom:hover {
            background-color: #138f9b;
            color: black;
        }

        .btn-outline-custom {
            border-color: #17a2b8;
            color: #17a2b8;
        }

        .btn-outline-custom:hover {
            background-color: #17a2b8;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="col-12">
        <div class="half">
            <div class="contents order-2 order-md-1">
                <div class="container mt-5 ">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6 singleView">
                            <div class="form-block ">
                                <div class="text-center mb-5 ">
                                    <h3>Forgot Password <strong>Section</strong></h3>

                                    <form action="#" method="post">
                                        <div class="form-group first">
                                            <input type="email" class="form-control" placeholder="Enter Your Email Address" id="email2" required>
                                        </div>

                                        <div class="col-12 text-center mt-4">
                                            <button type="button" class="btn btn-custom" onclick="forgotPassword();">Reset the Password</button>
                                        </div>

                                        <div class="col-12 d-grid mt-3">
                                            <a href="signIn.php"><button type="button" class="btn btn-outline-custom">Back to Login Page</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">New Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="np" />
                                    <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();">Show</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Re-type Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="rnp" />
                                    <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Verification Code</label>
                                <input type="text" class="form-control" id="vc" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->

        <div class="text-center mt-5">
            <img src="resources/logo/lotus.webp" style="width: 185px;" alt="logo">
            <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

<script>
    var bm;

    function forgotPassword() {
        var email = document.getElementById("email2").value;

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "Success") {
                    swal("Verification code has been sent to your Email. Please check your inbox.", {
                        icon: "success",
                    }).then(() => {
                        var m = document.getElementById("forgotPasswordModal");
                        bm = new bootstrap.Modal(m);
                        bm.show();
                    });
                } else {
                    swal("Something Went Wrong!", t, "error");
                }
            }
        };

        r.open("GET", "forgotPasswordProcess.php?e=" + email, true);
        r.send();
    }

    function showPassword() {
        var np = document.getElementById("np");
        var npb = document.getElementById("npb");

        if (np.type == "password") {
            np.type = "text";
            npb.innerHTML = "Hide";
        } else {
            np.type = "password";
            npb.innerHTML = "Show";
        }
    }

    function showPassword2() {
        var rnp = document.getElementById("rnp");
        var rnpb = document.getElementById("rnpb");

        if (rnp.type == "password") {
            rnp.type = "text";
            rnpb.innerHTML = "Hide";
        } else {
            rnp.type = "password";
            rnpb.innerHTML = "Show";
        }
    }

    function resetPassword() {
        var email = document.getElementById("email2").value;
        var np = document.getElementById("np").value;
        var rnp = document.getElementById("rnp").value;
        var vcode = document.getElementById("vc").value;

        var f = new FormData();
        f.append("e", email);
        f.append("n", np);
        f.append("r", rnp);
        f.append("v", vcode);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    swal("Your Password has been updated.", {
                        icon: "success",
                    }).then(() => {
                        bm.hide();
                        window.location = "signIn.php";
                    });
                } else {
                    swal("Error", t, "error");
                }
            }
        };

        r.open("POST", "resetPasswordProcess.php", true);
        r.send(f);
    }
</script>

</html>
