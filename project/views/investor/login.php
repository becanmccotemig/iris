<?php
include "../../model/investor.php";
include "../../database/database.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="form-group"> Login Investidor </h1>
        <form action="../../controllers/investor/login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Senha " name="password" class="form-control">
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="login" class="btn btn-primary"> Logar </button>
            </div> 
        </form>
        <div>
            <p> Não possui conta? <a href="registration.php"> Criar conta </a></p>
        </div>
        <div>
            <p> É uma STARTUP já cadastrada? <a href="../startup/login.php"> Logar </a></p>
        </div>
        <div>
        <?php

            if (isset($_GET["email"])) {
                if($_GET["email"] == "enviado") {
                    echo "<div class='alert alert-success'> Seu email foi enviado com sucesso para nossa equipe! </div>";
                }
            }

            if (isset($_GET["delete"])) {
                if($_GET["delete"] == "deletado") {
                    echo "<div class='alert alert-success'> Conta deletada com sucesso, faça login em outra conta ou crie uma nova! </div>";
                }
            }

            if (isset($_GET["cadastro"])) {
                if($_GET["cadastro"] == "cadastrado") {
                    echo "<div class='alert alert-success'> Registro feito com sucesso, agora você poderá realizar login! </div>";
                }
            }

            if (isset($_GET["update"])) {
                if($_GET["update"] == "updated") {
                    echo "<div class='alert alert-success'> Você fez alterações em sua conta, e para sua segurança, faça login novamente! </div>";
                }
            }

            if (isset($_GET["password"])) {
                if($_GET["password"] == "updated") {
                    echo "<div class='alert alert-success'> Você fez alterações na sua senha, e para sua segurança, faça login novamente! </div>";
                }
            }
        ?>
            <p> <a href="reset-password.php"> Esqueceu a senha? </a> </p>
        </div>
    </div>
</body>
</html>