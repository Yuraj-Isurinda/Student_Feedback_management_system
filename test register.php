<?php

//Add database file
require_once "database_connection.php";
require_once "test validation.php";

//if user click the Create account button

if(isset($_POST["btn-submit"])){

    //get form input data
    $regNo = $_POST["regNo"];
    $index = $_POST["indexNo"];
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $semester = $_POST["semester"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repass = $_POST["confirm_password"];
    $badge = $_POST["badge"];
    $dep = $_POST["department"];

    // input validation

    if(inputEmptyReg($regNo,$index,$fname,$lname,$semester,$email,$password, $repass,$badge,$dep)){
        header("location:./test create-Account.php?err=empty_index");
        exit();
    }

    else if(passwordMatch($password,$repass)){
        header("location:./test create-Account.php?err=password_not_match");
    }
    else if(regNoAvailable($pdo,$regNo)){
        header("location:./test create-Account.php?err=email_available_the_system");
    }
    else{
// Example call to registerNewUser function
        registerNewUser($pdo, $regNo, $index, $badge, $semester, $fname, $lname, $email, $password, $dep);
    }
}
else{
    header("location:./test create-Account.php");
    exit();
}









?>