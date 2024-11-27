<?php
// Conectar ao banco de dados (ajuste conforme necessário)
include "../../model/investor.php";
include "../../database/database.php"; // Certifique-se de que o arquivo contém as funções necessárias

// Recuperar o ID da URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $postDetails = detailsPost($conn, $id);

    if ($postDetails) {
        $titulo = $postDetails['post_title'];
        $startupName = $postDetails['startup_name'];
        $category = $postDetails['post_category'];
        $body = $postDetails['post_body'];
    } else {
        echo "<p>Erro: Post não encontrado.</p>";
        exit;
    }
} else {
    // Caso não haja um ID na URL
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
    <link rel="stylesheet" href="../../components/header/investor/header.css">
    <link rel="stylesheet" href="../../components/header/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/details-post-startup.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Startup Posts</title>
</head>

<body>
    <?php
    include_once '../../components/header/investor/header.php';
    ?>
    <div class="container main-content">
        <h1 class="details-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <h4 class="details-subtitle">Startup: <?php echo htmlspecialchars($startupName); ?></h4>
        <h4 class="details-subtitle">Categoria: <?php echo htmlspecialchars($category); ?></h4>
        <p class="details-post"><?php echo nl2br(htmlspecialchars($body)); ?></p>
        <a href="posts.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <?php
    include_once '../../components/header/investor/footer.php';
    ?>
</body>

</html>