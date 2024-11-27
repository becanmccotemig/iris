<?php
include "../../model/post.php";
include "../../database/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);
    $post = detailsPost($conn, $id);
    $titulo = $post['post_title'];
    $startupName = $post['nomeStartup'];
    $category = $post['post_category'];
    $body = $post['post_body'];

} else {
    echo "<p>Erro: Nenhum ID foi fornecido.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/header/startup/header.css">
    <link rel="stylesheet" href="../../components/header/startup/footer.css">
    <link rel="stylesheet" href="../../design/startups/details-post.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Post Details</title>
</head>

<body>
    <?php
    include_once '../../components/header/startup/header.php';
    ?>
    <div class="container main-content">
        <h1> <?php echo $titulo; ?> </h1>
        <h4> Startup: <?php echo $startupName; ?> </h4>
        <h4> Categoria: <?php echo $category; ?> </h4>
        <p> <?php echo $body; ?></p>


        <form action="edit-post.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="edit-button" class="btn btn-warning">Editar post</button>
        </form>

        <form action="delete-post.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="delete-button" class="btn btn-danger">Excluir post</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Voltar para perfil </a>
    </div>
    <?php
    include_once '../../components/header/startup/footer.php';
    ?>
</body>

</html>