<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- // CSS -->
    <link rel="stylesheet" href="../../design/startups/login.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Login</title>
</head>

<body>
    <div class="marca">
        <img class="logo" src="/teste-git/iris/project/components/icons/logo.svg">
        <h1>Íris</h1>
    </div>
    <div class="container">
        <h1 class="form-title"> Login Startup </h1>
        <form class="form-container" action="../../controllers/startup/login.php" method="post">
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
            <p> É um INVESTIDOR já cadastrado? <a href="../investor/login.php"> Logar </a></p>
        </div>
        <div>
            <?php
            if (isset($_GET["update"])) {
                if ($_GET["update"] == "updated") {
                    echo "<div class='alert alert-success'> Você fez alterações em sua conta, e para sua segurança, faça login novamente! </div>";
                }
            }

            if (isset($_GET["delete"])) {
                if ($_GET["delete"] == "deletado") {
                    echo "<div class='alert alert-success'> Conta deletada com sucesso, faça login em outra conta ou crie uma nova! </div>";
                }
            }

            if (isset($_GET["email"])) {
                if ($_GET["email"] == "emailenviado") {
                    echo "<div class='alert alert-success'> Email de contato enviado </div>";
                } else if ($_GET["email"] == "invalid") {
                    echo "<div class='alert alert-danger'> Email invalido ou não cadastrado! </div>";
                }
            }

            if (isset($_GET["password"])) {
                if ($_GET["password"] == "incorrect") {
                    echo "<div class='alert alert-danger'> Senha incorreta, tente novamente! </div>";
                } else if ($_GET["password"] == "updated") {
                    echo "<div class='alert alert-success'> Você fez alterações na sua senha, e para sua segurança, faça login novamente! </div>";
                }
            }

            if (isset($_GET["session"])) {
                if ($_GET["session"] == "error") {
                    echo "<div class='alert alert-danger'> Faça login para executar essa ação! </div>";
                }
            }
            ?>

        </div>
    </div>
</body>

</html>