function signUp() {

    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", pw.value);
    f.append("mobile", m.value);
    f.append("gender", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
                window.location = "signIn.php";

            } else {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";

            }

        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

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

    r.open("GET", "signoutProcess.php", true);
    r.send();

}

function loadProduct(x) {
    var page = x;
    //alert(x);

    var f = new FormData();
    f.append("p", page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            document.getElementById("vid").innerHTML = response;

        }
    };

    request.open("POST", "loadVehicleProcess.php", true);
    request.send(f);

}

function basicSearch(x) {
    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}

function advancedSearch(page) {
    var form = document.getElementById("advancedSearchForm");
    var formData = new FormData(form);
    formData.append("page", page);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "advancedSearchProcess.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("advancedSearchResult").innerHTML = xhr.responseText;
        }
    };

    xhr.send(formData);
}


function changeImage(imagePath) {
    document.getElementById('product-image').src = imagePath;

}

function qty_dec() {
    var input = document.getElementById("qty");

    if (input.value > 1) {

        var new_value = parseInt(input.value) - 1;
        input.value = new_value;

    } else {

        swal("Something Went Wrong!", "You have Reached to the Minimum!", "error");
        input.value = 1;

    }
}

function qty_inc(qty) {
    var input = document.getElementById("qty");

    if (input.value < qty) {

        var new_value = parseInt(input.value) + 1;
        input.value = new_value;

    } else {

        swal("Something Went Wrong!", "You have Reached to the Maximum!", "error");
        input.value = qty;

    }
}

function addtoCart(x) {
    //alert(x);
    var vehicleId = x;
    var qty = document.getElementById("qty");

    if (qty.value > 0) {

        var f = new FormData();
        f.append("v", vehicleId);
        f.append("q", qty.value);

        var request = new XMLHttpRequest();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response === "Cart item updated successfully" || response === "Cart item added successfully") {
                    swal("Good job!", response, "success");
                } else if (response === "Please Sign in to add to cart") {
                    swal("Login Required", response, "error");
                } else if (response === "Stock quantity has been exceeded!") {
                    swal("Out of Stock", response, "warning");
                } else if (response === "Invalid request" || response === "Invalid quantity") {
                    swal("Error", response, "error");
                } else {
                    swal("Error", "An unexpected error occurred", "error");
                }

                qty.value = "";
            }
        }

        request.open("POST", "addtoCartProcess.php", true);
        request.send(f);

    } else {
        swal("Something Went Wrong!", "Please Enter Valid Quantity", "error");
    }

}

function loadCart() {
    //alert("ok");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            document.getElementById("cardBody").innerHTML = response;

        }
    }

    request.open("POST", "loadCartProcess.php", true);
    request.send();
}

function incrementCartQty(x) {
    var cartId = x;
    var qtyInput = document.getElementById("qty" + x);
    var newQty = parseInt(qtyInput.value) + 1;

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response === "Success") {
                qtyInput.value = newQty;
                location.reload(); // Reload the page to update the cart
            } else {
                swal("Something Went Wrong!", response, "error");
            }
        }
    };

    request.open("POST", "updateCartQtyProcess.php", true);
    request.send(f);
}

function decrementCartQty(x) {
    var cartId = x;
    var qtyInput = document.getElementById("qty" + x);
    var newQty = parseInt(qtyInput.value) - 1;

    if (newQty < 1) {
        ; swal("Something Went Wrong!", "Quantity cannot be less than 1", "error");
        return;
    }

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response === "Success") {
                qtyInput.value = newQty;
                location.reload(); // Reload the page to update the cart
            } else {
                swal("Something Went Wrong!", response, "error");
            }
        }
    };

    request.open("POST", "updateCartQtyProcess.php", true);
    request.send(f);
}

function removeCart(x) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this vehicle!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var f = new FormData();
                f.append("c", x);

                var request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        var response = request.responseText;
                        swal("Poof! Your vehicle has been deleted!", {
                            icon: "success",
                        }).then(() => {
                            location.reload();
                        });
                    }
                };

                request.open("POST", "removeCartProcess.php", true);
                request.send(f);
            } else {
                swal("Your vehicle is safe!");
            }
        });
}


function checkOut() {
    var f = new FormData();
    f.append("cart", true);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            try {
                var response = request.responseText;
                var payment = JSON.parse(response);
                doCheckout(payment, "checkoutProcess.php");
            } catch (e) {
                console.error("Failed to parse JSON response:", e, response);
            }
        }
    };

    request.open("POST", "paymentProcess.php", true);
    request.send(f);
}

function doCheckout(payment, path) {
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer

        var f = new FormData();
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                //alert(response);
                var order = JSON.parse(response);

                if (order.resp == "Success") {
                    //location.reload();
                    window.location = "invoice.php?orderId=" + order.order_id;

                } else {
                    swal("Something Went Wrong!", response, "error");
                }
            }
        };

        request.open("POST", path, true);
        request.send(f);
    };

    payhere.onDismissed = function onDismissed() {
        console.log("Payment dismissed");
    };

    payhere.onError = function onError(error) {
        console.log("Error:" + error);
    };

    payhere.startPayment(payment);
}

function reload() {
    location.reload();

}

function buyNow(vehicleId) {
    //alert(vehicleId);
    var qty = document.getElementById("qty");

    if (qty.value > 0) {
        //alert("ok");
        var f = new FormData();
        f.append("cart", false);
        f.append("vehicleId", vehicleId);
        f.append("qty", qty.value);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                //alert(response);
                var payment = JSON.parse(response);
                payment.vehicle_id = vehicleId;
                payment.qty = qty.value;
                doCheckout(payment, "buyNowProcess.php")

            }
        };

        request.open("POST", "paymentProcess.php", true);
        request.send(f);

    } else {
        swal("Something Went Wrong!", "Please Enter Valid Quantity", "error");

    }

}

function printDiv() {
    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printArea").innerHTML;

    document.body.innerHTML = printArea;

    window.print();

    document.body.innerHTML = originalContent;

}