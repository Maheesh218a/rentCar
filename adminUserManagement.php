<?php
include "connection.php";
session_start();

if (isset($_SESSION["u"])) {

?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="adminStyle.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Admin Customer Management</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body class="adminBody" onload="loadUser();">
        <!-- NavBar -->
        <?php include "adminHeader.php" ?>
        <!-- NavBar -->

        <!-- Modal -->
        <div class="modal modalBody1" tabindex="-1" id="msgDiv1" onclick="reload();">
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

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center fw-bold">User Management</h2>
                    <div class="d-none" id="msgDiv" onclick="reload();">
                        <div class="alert alert-danger" id="msg"></div>
                    </div>
                    <div class="mt-5 table-responsive">
                        <table class="table table-bordered table-dark table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Joined Date</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status Change</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email` != 'maheeshaudalagama@gmail.com' ORDER BY fname ASC");
                                $urows = $user_rs->num_rows;
                                for ($i = 0; $i < $urows; $i++) {
                                    $user_data = $user_rs->fetch_assoc();
                                ?>
                                    <tr class="text-white">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></p>
                                                    <p class="text-muted mb-0" id="mail<?php echo $i ?>"><?php echo $user_data["email"] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?php echo $user_data["mobile"] ?></p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?php echo $user_data["joined_date"] ?></p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?php echo $user_data["gender_id"] == 1 ? "Male" : "Female"; ?></p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?php echo $user_data["status"] == 1 ? "Active" : "Deactive"; ?></p>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-status" type="checkbox" role="switch" id="id<?php echo $i ?>" onchange="changeUserStatus(<?php echo $i ?>);" <?php echo $user_data["status"] == 2 ? "checked" : ""; ?>>
                                                <label class="form-check-label" for="id<?php echo $i ?>"></label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="fixed-bottom col-12">
            <p class="text-center"> &copf; 2024 Lotus Rent Car || All Right Reserved</p>
        </div>
        <!-- Footer -->

        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin Panel</title>
        <link rel="icon" href="resources/logo/lotus.webp">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body style="background-color: #CCCCCC;">
        <h1 class="text-center fw-bold">You are not valid admin</h1>
        <h3 class="text-center">Please log in as admin <br> and try again</h3>
        <hr>
        <div class="col-12 text-center">
            <a href="adminIndex.php">
                <button class="btn btn-primary text-center fw-bold">Log In as Admin</button>
            </a>
        </div>
        <hr>
        <div class="text-center">
            <img src="resources/logo/lotus.webp" style="width: 185px;" alt="logo">
            <h4 class="mt-1 mb-5 pb-1">Admin of Lotus Team</h4>
        </div>
        <hr>
        <h5 class="text-end fw-bold">Not Allowed non-authorised Peoples</h5>
        <hr>
    </body>
    </html>
<?php
}
?>
