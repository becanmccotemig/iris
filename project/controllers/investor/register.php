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
        echo "<div class='alert alert-danger'> Todos os campos devem ser preenchidos </div>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'> Email inválido </div>";
    } else if(strlen($password) < 8) {
        echo "<div class='alert alert-danger'> Senha deve ter no mínimo 8 caracteres </div>";
    } else if($password !== $passwordRepeat) {
        echo "<div class='alert alert-danger'> As senhas não conferem, tente novamente! </div>";
    } else {
        register($conn, $fullName, $email, $passwordHash);
    }
        


}


