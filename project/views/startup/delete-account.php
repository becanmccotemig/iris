<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/startup/header.css">
    <link rel="stylesheet" href="../../components/startup/footer.css">
    <link rel="stylesheet" href="../../design/startups/delete-account.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Delete Account</title>
</head>

<body>
    <?php
    include_once '../../components/startup/header.php';
    ?>
    <div class="container main-content">
        <h1 class="title">Deletar conta</h1>
        <p class="subtitle">Ao clicar no botão abaixo, você entende que sua conta, junto com os seus dados serão deletados!</p>

        <!-- Formulário para enviar o id para a página de confirmação de exclusão -->
        <form action="../../controllers/startup/delete-account.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="delete-button" class="btn btn-danger">Excluir conta</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    <?php
    include_once '../../components/startup/footer.php';
    ?>
</body>

</html>