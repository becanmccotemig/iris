<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- // CSS -->
    <link rel="stylesheet" href="../../design/investors/registration.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Registration Form</title>
</head>

<body>
    <div class="container">
        <h1 class="form-title"> Cadastrar Investidor </h1>
        <form class="form-container" action="../../controllers/investor/register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Nome">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Senha">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repetir senha">
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="register" class="btn btn-primary"> Cadastrar </button>
            </div>
        </form>
        <div>
            <p> Já possui conta? <a href="login.php">Login</a></p>
        </div>
        <div>
            <p> Deseja criar conta STARTUP? <a href="../../views/startup/registration.php"> Criar </a></p>
        </div>
        <?php

        if (isset($_GET["fields"])) {
            if ($_GET["fields"] == "empty") {
                echo "<div class='alert alert-danger'> Todos os campos devem ser preenchidos! </div>";
            }
        }

        if (isset($_GET["email"])) {
            if ($_GET["email"] == "invalid") {
                echo "<div class='alert alert-danger'> Email inválido! </div>";
            } else if ($_GET["email"] == "error") {
                echo "<div class='alert alert-danger'> Email já cadastrado! </div>";
            }
        }

        if (isset($_GET["password"])) {
            if ($_GET["password"] == "invalid") {
                echo "<div class='alert alert-danger'> Senha deve conter no mínimo 8 caracteres </div>";
            } else if ($_GET["password"] == "different") {
                echo "<div class='alert alert-danger'> As senhas não conferem! </div>";
            }
        }

        if (isset($_GET["register"])) {
            if ($_GET["register"] == "success") {
                echo "<div class='alert alert-success'> Registro feito com sucesso, agora você poderá realizar login! </div>";
            } else if ($_GET["register"] == "error") {
                echo "<div class='alert alert-danger'> Houve um erro no seu cadastro, tente novamente! </div>";
            }
        }


        ?>
    </div>
</body>

</html>