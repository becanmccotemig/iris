<?php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Investor Index</title>
</head>
<body>


<?php 
    include_once '../../components/header/investor/header.php';
?>
    <div class="container">
        <h1>Bem-vindo, <?php echo $full_name; ?></h1>
        <p>Seu email: <?php echo $email; ?></p>
        <!-- Editar Senha -->
        <form action="../../views/investor/edit-password.php" method="post">
            <label for="edit-password"> Deseja redefinir sua senha? </label>
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="edit-password" class="btn btn-warning">Editar senha</button>
        </form>
        <!-- Editar informações -->
        <form action="../../views/investor/edit.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="edit-info" class="btn btn-warning">Editar informações</button>
        </form>
        <!-- Deslogar -->
        <a href="../../controllers/investor/logout.php" class="btn btn-warning">Deslogar</a>
        <!-- Excluir conta -->
        <form action="delete-account.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="delete-button" class="btn btn-danger">Excluir conta</button>
        </form>
    </div>

    <?php
        if (isset($_GET["email"])) {
            if($_GET["email"] == "emailenviado") {
                echo "<div class='alert alert-success'> Email de contato enviado </div>";
            }
        }

    ?>
</body>
</html>
