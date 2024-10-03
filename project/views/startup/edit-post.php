<?php
session_start();
include("../../database/database.php");

// Verificar se o id foi passado via GET
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    echo "Post ID não fornecido.";
    exit();
}

$sql = "SELECT * FROM post WHERE id = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed";
} else {
    mysqli_stmt_bind_param($stmt, "s", $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Post $post_id não encontrado!</div>";
        $post = null;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Startup Edit Post</title>
</head>
<body>
    <div class="container">
        <h1> Escrever um post </h1>
        <p> Aqui você pode escrever uma atualização sobre um projeto recentemente desenvolvido, publicar alguma pesquisa e etc. Ao finalizar, o que você escrever será adicionado a área de publicações na sua página para outras pessoas poderem vizualizar!</p>
        
        <!-- Formulário para enviar o id para a página de confirmação de exclusão -->
        <form action="../../controllers/startup/edit-post-process.php" method="post">
            <div>
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($post_id); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-title" placeholder="Título" value="<?php echo htmlspecialchars($post['post_title']); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-category" placeholder="Categoria" value="<?php echo htmlspecialchars($post['post_category']); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="post-author" placeholder="Autor" value="<?php echo htmlspecialchars($post['post_author']); ?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="post-description" placeholder="Uma breve descrição do seu post" id=""><?php echo htmlspecialchars($post['post_description']); ?></textarea>
                
            </div>
            <div class="form-group">
                <textarea class="form-control" name="post-body" placeholder="Corpo do seu post" id=""><?php echo htmlspecialchars($post['post_body']); ?></textarea>
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="submitEditPost" class="btn btn-primary"> Enviar Post </button>
            </div> 
        </form>

        <div class="form-group form-btn">
            <a href="index.php" class="btn btn-secondary mt-3"> Voltar para perfil</a>
        </div>
        
        
    </div>
</body>
</html>
