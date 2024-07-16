function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            }
        }
    };

    r.open("GET", "adminSignoutProcess.php", true);
    r.send();

}

function changeUserStatus(i) {

    var mailElement = document.getElementById("mail" + i);
    var email = mailElement.innerHTML;
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Active Success" || t == "Inactive Success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: Success </p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + r + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    }

    r.open("GET", "adminChangeUserStatusProcess.php?e=" + email, true);
    r.send();
}

function updateUserStatus() {
    var userid = document.getElementById("uid");
    // alert(userid.value);

    var f = new FormData();
    f.append("u", userid.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            if (response == "Deactive") {
                document.getElementById("msg").innerHTML = "Now This Person is Deactive Person";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgDiv").className = "d-block";

                userid.value = "";
                loadUser();


            } else if (response == "Active") {
                document.getElementById("msg").innerHTML = "Now This Person is Active Person";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgDiv").className = "d-block";

                userid.value = "";
                loadUser();

            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgDiv").className = "d-block";

                userid.value = "";
                loadUser();

            }

        }
    };

    request.open("POST", "adminUpdateUserStatusProcess.php", true);
    request.send(f);

}

function reload() {
    location.reload();

}

function brandReg() {
    var brand = document.getElementById("brand");
    //alert(brand.value);

    var f = new FormData();
    f.append("b", brand.value);

    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
                brand.value = "";

            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();

            }

        }
    };

    request.open("POST", "adminBrandRegisterProcess.php", true);
    request.send(f);

}

function categoryReg() {
    var cat = document.getElementById("cat");
    //alert(cat.value);

    var f = new FormData();
    f.append("c", cat.value);

    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
                brand.value = "";

            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();

            }

        }
    }

    request.open("POST", "adminCategoryRegisterProcess.php", true);
    request.send(f);

}

function colorReg() {
    var color = document.getElementById("color");
    //alert(color.value);

    var f = new FormData();
    f.append("c", color.value);

    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
                brand.value = "";

            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();

            }

        }
    };

    request.open("POST", "adminColorRegisterProcess.php", true);
    request.send(f);

}

function seatReg() {
    var size = document.getElementById("size");
    //alert(size.value);

    var f = new FormData();
    f.append("s", size.value);

    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
                brand.value = "";

            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();

            }

        }
    }

    request.open("POST", "adminSeatRegisterProcess.php", true);
    request.send(f);

}

function changeVehicleStatus(id) {
    //alert ("OK");
    var vehicle_id = id;
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Deactivated Successfully" || response == "Activated Successfully") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }

        }
    }

    request.open("POST", "adminChangeVehicleStatusProcess.php?p=" + vehicle_id, true);
    request.send();

}

function confirmDelete(id) {
    var result = confirm("Are you sure you want to delete this product?");
    if (result) {
        deleteProduct(id);
    }
}

function deleteProduct(id) {
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response === "success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class='error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    }

    request.open("POST", "adminDeleteProduct.php?id=" + id, true);
    request.send();
}


function filter(x) {
    //alert("OK");

    var search = document.getElementById("search");
    var sortBy = document.getElementById("select");
    var conditionBy = document.getElementById("condition");

    //alert(search.value);
    //alert(sortBy.value);
    //alert(conditionBy.value);

    var f = new FormData();
    f.append("search", search.value);
    f.append("sort", sortBy.value);
    f.append("condition", conditionBy.value);
    f.append("page", x);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            document.getElementById("sort").innerHTML = response;


        }
    }

    request.open("POST", "adminSortProcess.php", true);
    request.send(f);

}

function sendId(id) {
    //alert("ok");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            if (response == "success") {
                window.location = "adminUpdateVehicle.php";
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    }
    request.open("GET", "adminSendIdProcess.php?id=" + id, true);
    request.send();

}

function fileSelect(event, imgNum) {
    const inputFile = event.target;
    const imgElement = document.getElementById(`vehicleImage${imgNum}`);

    if (inputFile.files && inputFile.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imgElement.src = e.target.result;
            imgElement.classList.remove("d-none");
        };

        reader.readAsDataURL(inputFile.files[0]);
    }
}

function fileSelectBlog(event, imgNumber) {
    var input = event.target;
    var file = input.files[0];

    if (file) {
        var url = window.URL.createObjectURL(file);
        var img = document.getElementById('blogImage' + imgNumber);
        img.src = url;
        img.className = "d-block";
    }
}

function addNewVehicle() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var color = document.getElementById("color");
    var seat = document.getElementById("seat");
    var district = document.getElementById("district");
    var title = document.getElementById("title");
    var man_year = document.getElementById("myear");
    var reg_year = document.getElementById("ryear");
    var condition = document.getElementById("condition");
    var contact = document.getElementById("contact");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var desc = document.getElementById("desc");
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    //alert(category.value);
    //alert(brand.value);
    //alert(color.value);
    //alert(seat.value);
    //alert(title.value);
    //alert(condition.value);
    //alert(qty.value);
    //alert(cost.value);
    //alert(desc.value);

    var f = new FormData();
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("clr", color.value);
    f.append("s", seat.value);
    f.append("d", district.value);
    f.append("t", title.value);
    f.append("my", man_year.value);
    f.append("ry", reg_year.value);
    f.append("con", condition.value)
    f.append("contact", contact.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("desc", desc.value);

    var fileInputs = ["file1", "file2", "file3", "file4"];
    fileInputs.forEach(function (fileInputId, index) {
        var fileInput = document.getElementById(fileInputId);
        if (fileInput.files.length > 0) {
            f.append("img" + index, fileInput.files[0]);
        }
    });

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }

        }
    }

    request.open("POST", "adminAddVehicleProcess.php", true);
    request.send(f);

}

function reloadS() {
    window.location = "adminBlogs.php";
}

function reloadR() {
    window.location = "adminBlogs.php";
}

function updateVehicle() {
    //alert("OK");

    var title = document.getElementById("title");
    var contact = document.getElementById("contact");
    var condition = document.getElementById("condition");
    var district = document.getElementById("district");
    var color = document.getElementById("color");
    var seat = document.getElementById("seat");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var description = document.getElementById("desc");

    var f = new FormData();
    f.append("t", title.value);
    f.append("contact", contact.value);
    f.append("con", condition.value);
    f.append("dis", district.value);
    f.append("clr", color.value);
    f.append("s", seat.value);
    f.append("q", qty.value);
    f.append("cos", cost.value);
    f.append("desc", description.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "success") {
                window.location = "adminManageVehicle.php";

            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "adminUpdateVehicleProcess.php", true);
    request.send(f);

}

function changeImage(imagePath) {
    document.getElementById('product-image').src = imagePath;

}

function addNewBlog() {
    //alert("ok");
    var title = document.getElementById("title");
    var author = document.getElementById("author");
    var link = document.getElementById("link");
    var s_desc = document.getElementById("sdesc");
    var desc = document.getElementById("desc");
    var file = document.getElementById("file");
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    //alert(title.value);
    //alert(author.value);
    //alert(link.value);
    //alert(s_desc.value);
    //alert(desc.value);
    //alert(file.value);

    var f = new FormData();
    f.append("title", title.value);
    f.append("author", author.value);
    f.append("link", link.value);
    f.append("s_description", s_desc.value);
    f.append("description", desc.value);
    f.append("image", file.files[0]);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    }

    request.open("POST", "adminAddNewBlogProcess.php", true);
    request.send(f);

}

function sendIdBlog(id) {
    //alert("ok");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            if (response == "success") {
                window.location = "adminUpdateBlog.php";
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    }
    request.open("GET", "adminSendIdBlogProcess.php?id=" + id, true);
    request.send();

}

function updateBlog() {
    var title = document.getElementById("title");
    var link = document.getElementById("link");
    var s_description = document.getElementById("sdesc");
    var description = document.getElementById("desc");
    var image = document.getElementById("file");
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var f = new FormData();
    f.append("t", title.value);
    f.append("l", link.value);
    f.append("s_desc", s_description.value);
    f.append("desc", description.value);
    if (image.files.length > 0) {
        f.append("image", image.files[0]);  // Ensure unique key for the file input
    }
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: Blog Update Successfully</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    };
    request.open("POST", "adminUpdateBlogProcess.php", true);
    request.send(f);
}

function changeBlogStatus(id) {
    //alert ("OK");
    var blog_id = id;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response == "Deactivated" || response == "Activated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "adminChangeBlogStatusProcess.php?p=" + blog_id, true);
    request.send();

}

function confirmDeleteBlog(id) {
    var result = confirm("Are you sure you want to delete this product?");
    if (result) {
        deleteBlog(id);
    }
}

function deleteBlog(id) {
    //alert("OK");
    var modalBody1 = document.querySelector("#msgDiv1 .modal-body1");
    var modalBody2 = document.querySelector("#msgDiv2 .modal-body2");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);

            if (response = "success") {
                modalBody1.innerHTML = "<p class='done-message'>Done: " + response + "</p>";
                var m1 = document.getElementById("msgDiv1");
                var bm1 = new bootstrap.Modal(m1);
                bm1.show();
            } else {
                modalBody2.innerHTML = "<p class=' error-message'>Error: " + response + "</p>";
                var m2 = document.getElementById("msgDiv2");
                var bm2 = new bootstrap.Modal(m2);
                bm2.show();
            }
        }
    }

    request.open("POST", "adminDeleteBlog.php?id=" + id, true);
    request.send();

}

function loadChart(){
    //alert("ok");

    var ctx = document.getElementById('myChart');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            var data = JSON.parse(response);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: data.labels,
                  datasets: [{
                    label: '# of Votes',
                    data: data.data,
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });

        }
    }

    request.open("POST", "adminLoadChartProcess.php", true);
    request.send();

}

function printDiv() {
    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printArea").innerHTML;

    document.body.innerHTML = printArea;

    window.print();

    document.body.innerHTML = originalContent;

}