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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Startup Delete Post</title>
</head>
<body>
    <div class="container">
        <h1>Deletar post</h1>
        <p>Ao clicar no botão abaixo, você entende que o post que você selecionou será deletado!</p>
        
        <!-- Formulário para enviar o id para a página de confirmação de exclusão -->
        <form action="../../controllers/startup/delete-post-request.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
            <button type="submit" name="delete-button" class="btn btn-danger">Excluir post</button>
        </form>
        
        <a href="index.php" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
</body>
</html>
