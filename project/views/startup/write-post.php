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
    <link rel="stylesheet" href="../../design/startups/write-post.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Write Post</title>
</head>

<body>
    <?php
    include_once '../../components/startup/header.php';
    ?>

    <div class="container main-content">
        <h1 class="title">Escrever um post </h1>
        <p class="subtitle"> Aqui você pode escrever uma post sobre um projeto recentemente desenvolvido, publicar
            alguma pesquisa
            e etc. Ao finalizar, o que você escrever será adicionado a área de publicações na sua página para outras
            pessoas poderem vizualizar!</p>

        <!-- Formulário para enviar o id para a página de confirmação de exclusão -->
        <form class="form-container" action="../../controllers/startup/write-post.php" method="post">
            <div>
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-title" placeholder="Título">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-category" placeholder="Categoria">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-author" placeholder="Autor">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="post-description" placeholder="Uma breve descrição do seu post"
                    id=""></textarea>

            </div>
            <div class="form-group">
                <textarea class="form-control" name="post-body" placeholder="Corpo do seu post" id=""></textarea>
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="submit-post" class="btn btn-primary"> Enviar Post </button>
            </div>
        </form>

        <div class="form-group form-btn">
            <a href="index.php" class="btn btn-secondary mt-3"> Voltar para perfil</a>
        </div>

        <?php
        if (isset($_GET["post"])) {
            if ($_GET["post"] == "error") {
                echo "<div class='alert alert-danger'> Ocorreu um erro ao publicar post, tente novamente! </div>";
            }
        }

        if (isset($_GET["fields"])) {
            if ($_GET["fields"] == "empty") {
                echo "<div class='alert alert-danger'> Todos os campos devem ser preenchidos! </div>";
            }
        }
        ?>
    </div>
    <?php
    include_once '../../components/startup/footer.php';
    ?>
</body>

</html>