<?php
include($_SERVER['DOCUMENT_ROOT'] . '/project/database/database.php');
session_start();

if (!isset($_SESSION["id"], $_SESSION["user"], $_SESSION["full_name"])) {
    header("Location: login.php");
    exit(); // Encerrar a execução para garantir que o código abaixo não seja executado
}

// Agora $_SESSION['id'], $_SESSION['user'] e $_SESSION['full_name'] contêm as informações do usuário
$user_id = $_SESSION["id"];
$email = $_SESSION["user"];
$full_name = $_SESSION["full_name"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/header/investor/header.css">
    <link rel="stylesheet" href="../../components/header/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/index.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Index</title>
</head>

<body>
    <?php
    include_once '../../components/header/investor/header.php';
    ?>
    <div class="container main-content">
        <h1 class="title">Bem-vindo, <span class="name"> <?php echo $full_name; ?></span></h1>
        <p><span class="extra-font">Seu email: </span> <?php echo $email; ?> </p>
        <!-- Editar Senha -->
        <form class="redefinir" action="../../views/investor/edit-password.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="edit-password" class="btn btn-warning">Redefinir senha</button>
        </form>
        <!-- Editar informações -->
        <form class="editar" action="../../views/investor/edit.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="edit-info" class="btn btn-warning">Editar informações</button>
        </form>
        <!-- Excluir conta -->
        <form class='deletar' action="delete-account.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="delete-button" class="btn btn-danger">Excluir conta</button>
        </form>
        <!-- Deslogar -->
        <a class="deslog" href="../../controllers/investor/logout.php" class="btn btn-warning">Deslogar</a>
    </div>

    <?php
    if (isset($_GET["email"])) {
        if ($_GET["email"] == "emailenviado") {
            echo "<div class='alert alert-success'> Email de contato enviado </div>";
        }
    }
    ?>
    <?php
    include_once '../../components/header/investor/footer.php';
    ?>
</body>

</html>