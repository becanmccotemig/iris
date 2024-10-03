<?php
// Conectar ao banco de dados (ajuste conforme necessário)
include("../../database/database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $id = mysqli_real_escape_string($conn, $id);

    $query = "SELECT * FROM post WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);

    $titulo = $post['post_title'];
    $startup = $post['startup_id'];
    $category = $post['post_category'];
    $body = $post['post_body'];

    $query = "SELECT nomeStartup FROM startups WHERE id = $startup";
    $result = mysqli_query($conn, $query);
    $startup = mysqli_fetch_assoc($result);
    $startupName = $startup['nomeStartup'];

} else {
    // Caso não haja um CNPJ na URL
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
    <title>Startup Post Details</title>
    <link rel="stylesheet" href="details.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    

    <!-- font montserrat font-family: "Montserrat", sans-serif;  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- font lato font-family: "Lato", sans-serif; -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>



    <div class="container">
        <h1>  <?php echo $titulo; ?> </h1>
            <h4> Startup: <?php echo $startupName; ?> </h4>
            <h4> Categoria: <?php echo $category; ?> </h4>
            <p> <?php echo $body; ?></p>
            
            <a href="index.php" class="btn btn-secondary mt-3">Voltar para perfil </a>      
            <a href="edit-post.php?id=<?php echo htmlspecialchars($id); ?>" class="btn btn-warning mt-3">Editar Post</a>
           
            <form action="delete-post.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($id); ?>">
                <button type="submit" name="delete-button" class="btn btn-danger">Excluir post</button>
            </form>
    </div>

        

    <footer class="footer">
        <!-- Seu rodapé aqui -->
    </footer>
</body>
</html>
