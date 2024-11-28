<?php
session_start();
include "../../model/post.php";
include "../../database/database.php";

// Verificar se o id foi passado via GET
if (isset($_POST['post_id']) || isset($_GET['post_id'])) {
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
    } else {
        $post_id = $_GET['post_id'];
    }

    $post = getInfo($conn, $post_id);
} else {
    echo "Post ID não fornecido.";
    exit();
}

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
    <link rel="stylesheet" href="../../design/startups/edit-post.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Edit Post</title>
</head>

<body>
    <?php
    include_once '../../components/startup/header.php';
    ?>
    <div class="container main-content">
        <h1 class="title"> Atualizar post </h1>
        <p class="subtitle"> Aqui você pode escrever uma atualização sobre um projeto recentemente desenvolvido,
            publicar alguma pesquisa
            e etc. Ao finalizar, o que você escrever será adicionado a área de publicações na sua página para outras
            pessoas poderem vizualizar!</p>

        <form class="form-container" action="../../controllers/startup/edit-post.php" method="post">
            <div>
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-title" placeholder="Título"
                    value="<?php echo htmlspecialchars($post['post_title']); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-category" placeholder="Categoria"
                    value="<?php echo htmlspecialchars($post['post_category']); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-author" placeholder="Autor"
                    value="<?php echo htmlspecialchars($post['post_author']); ?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="post-description" placeholder="Uma breve descrição do seu post"
                    id=""><?php echo htmlspecialchars($post['post_description']); ?></textarea>

            </div>
            <div class="form-group">
                <textarea class="form-control" name="post-body" placeholder="Corpo do seu post"
                    id=""><?php echo htmlspecialchars($post['post_body']); ?></textarea>
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="edit-post" class="btn btn-primary"> Enviar Post </button>
            </div>
        </form>

        <div class="form-group form-btn">
            <a href="index.php" class="btn btn-secondary mt-3"> Voltar para perfil</a>
        </div>

        <?php
        if (isset($_GET["update"])) {
            if ($_GET["update"] == "notUpdated") {
                echo "<div class='alert alert-danger'> Não foi possível fazer a atualização de sua informações, tente novamente! </div>";
            }
        }

        if (isset($_GET["fields"])) {
            if ($_GET["fields"] == "empty") {
                echo "<div class='alert alert-danger'>Todos os campos devem ser preenchidos </div>";
            }
        }
        ?>
    </div>
    <?php
    include_once '../../components/startup/footer.php';
    ?>
</body>

</html>