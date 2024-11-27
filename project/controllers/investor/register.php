<?php
include "../../model/investor.php";
include "../../database/database.php";


if (isset($_POST["register"])) {
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    

    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../../views/investor/registration.php?fields=empty");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../views/investor/registration.php?email=invalid");
        exit();
    } else if(strlen($password) < 8) {
        header("Location: ../../views/investpr/registration.php?password=invalid");
        exit();
    } else if($password !== $passwordRepeat) {
        header("Location: ../../views/investor/registration.php?password=different");
        exit();
    } else {
        register($conn, $fullName, $email, $passwordHash);
    }
        


}


