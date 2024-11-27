<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$post_id = $_POST["post_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/header/startup/header.css">
    <link rel="stylesheet" href="../../components/header/startup/footer.css">
    <link rel="stylesheet" href="../../design/startups/delete-post.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Delete Post</title>
</head>

<body>
    <?php
    include_once '../../components/header/startup/header.php';
    ?>
    <div class="container main-content">
        <h1>Deletar post</h1>
        <p>Ao clicar no botão abaixo, você entende que o post que você selecionou será deletado!</p>

        <form action="../../controllers/startup/delete-post.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
            <button type="submit" name="delete-button" class="btn btn-danger">Excluir post</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    <?php
    include_once '../../components/header/startup/footer.php';
    ?>
</body>

</html>