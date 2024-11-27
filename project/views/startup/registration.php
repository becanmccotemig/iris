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
    <link rel="stylesheet" href="../../design/startups/registration.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Sign Up</title>
</head>

<body>
    <div class="container">
        <h1 class="form-title"> Cadastrar Startup </h1>
        <form class="form-container" action="../../controllers/startup/registration.php" method="post"
            enctype="multipart/form-data">
            <label> Primeiramente, insira as informações técnicas de sua startup </label>
            <div class="form-group">
                <input type="text" class="form-control" name="startupName" placeholder="Nome">
            </div>
            <div class="form-btn form-group">
                <textarea name="descricao" class="form-control"
                    placeholder="Use este campo para fazer uma descrição de sua Startup!"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="criador" placeholder="Criador/es da Startup">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="area" placeholder="Area de atuação">
            </div>
            <div class="form-group">
                <textarea name="endereco" class="form-control"
                    placeholder="Endereço onde sua startup esta situada"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="contato" placeholder="Numero de contato">
            </div>
            <div class="form-group">
                <input type="url" class="form-control" name="link" placeholder="Link do seu website ou portfolio">
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="imagem" placeholder="Logo da sua Startup">
            </div>
            <label> Agora, digite as credenciais para cadastrarmos sua Startup! </label>
            <div class="form-group">
                <input type="email" class="form-control" name="emailStartup" placeholder="Email">
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
        <div class="texts">
            <div>
                <p> Já possui conta? <a href="login.php">Logar</a></p>
            </div>
            <div>
                <p> Deseja criar conta INVESTIDOR? <a href="../../views/investor/registration.php"> Criar </a></p>
            </div>
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