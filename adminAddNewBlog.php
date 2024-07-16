<?php
session_start();

if (isset($_SESSION["u"])) { ?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <title>Add New Blogs</title>
        <link rel="icon" href="resources/logo/lotus.webp">
    </head>

    <body class="offset-1">

        <!-- Modal -->
        <div class="modal modalBody1" tabindex="-1" id="msgDiv1" onclick="reloadR();">
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

        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="manageBlogs.php">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Blogs</li>
            </ol>
        </nav>

        <div class="container mt-4 mb-5">
            <div class="card mt-6 shadow-6-strong">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Add New Blog</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label" for="title">Add Title of the Blog</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label" for="author">Author Name of the Blog</label>
                            <input type="text" class="form-control" id="author">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label" for="link">Add Source Link</label>
                            <input type="text" class="form-control" id="link">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label" for="sdesc">Add Small Description of the Blog</label>
                            <input type="text" class="form-control" id="sdesc" placeholder="Less than 40 characters">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label" for="desc">Add Full Description of the Blog</label>
                            <textarea class="form-control" id="desc" rows="10" placeholder="Enter blog description"></textarea>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Add Blog Images</label><br>
                        <small>Please select all images at once.</small>
                        <div class="d-flex flex-wrap">
                            <div class="p-2">
                                <input type="file" class="form-control-file" id="file" onchange="fileSelect(event,1)"><br>
                                <img src="resources/logo/upload.png" class="img-fluid d-none" style="width: 200px;" id="vehicleImage1" />
                            </div>
                        </div>
                        <button class="btn btn-outline-info col-12 mt-4" onclick="addNewBlog();">Save Blog</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="adminScript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php } else {
    header("Location:adminIndex.php");
} ?>