<?php

session_start();
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];

if(empty($email)){
    echo ("Please enter your Email Address.");
}else if(strlen($email) > 100){
    echo ("Incorrect Email Address.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Not a valid Email Address.");
}else if(empty($password)){
    echo ("Please enter your Password.");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Incorrect password.");
}else{

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."' AND 
    `password`='".$password."'");

    $n = $rs->num_rows;

    if($n == 1){

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

    }else{
        echo ("Invalid Email Address or Password");
    }

}

?>