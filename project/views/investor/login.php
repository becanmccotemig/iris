<?php
include "../../model/investor.php";
include "../../database/database.php";
include($_SERVER['DOCUMENT_ROOT'] . '/project/database/database.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- // CSS -->
    <link rel="stylesheet" href="../../design/investors/login.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Login</title>
</head>

<body>
    <div class="marca">
        <img src="">
        <h1>ÍRIS</h1>
    </div>
    <div class="container">
        <h1 class="form-title"> Login Investidor </h1>
        <form class="form-container" action="../../controllers/investor/login.php" method="post">
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
        <p> <a href="reset-password.php"> Esqueceu a senha? </a> </p>

        <div>
            <?php

            if (isset($_GET["email"])) {
                if ($_GET["email"] == "enviado") {
                    echo "<div class='alert alert-success'> Seu email foi enviado com sucesso para nossa equipe! </div>";
                }
            }

            if (isset($_GET["delete"])) {
                if ($_GET["delete"] == "deletado") {
                    echo "<div class='alert alert-success'> Conta deletada com sucesso, faça login em outra conta ou crie uma nova! </div>";
                }
            }

            if (isset($_GET["cadastro"])) {
                if ($_GET["cadastro"] == "cadastrado") {
                    echo "<div class='alert alert-success'> Registro feito com sucesso, agora você poderá realizar login! </div>";
                }
            }

            if (isset($_GET["update"])) {
                if ($_GET["update"] == "updated") {
                    echo "<div class='alert alert-success'> Você fez alterações em sua conta, e para sua segurança, faça login novamente! </div>";
                }
            }

            if (isset($_GET["password"])) {
                if ($_GET["password"] == "incorrect") {
                    echo "<div class='alert alert-danger'> Senha incorreta, tente novamente! </div>";
                } else if ($_GET["password"] == "updated") {
                    echo "<div class='alert alert-success'> Você fez alterações na sua senha, e para sua segurança, faça login novamente! </div>";
                }
            }

            ?>

        </div>
    </div>
</body>

</html>