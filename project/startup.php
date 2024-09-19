<?php
// Conectar ao banco de dados (ajuste conforme necessário)
include("database.php");

// Recuperar o CNPJ da URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM startups WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);

    $startup_id = $post['id'];
    $nomeStartup = $post['nomeStartup'];
    $descricao = $post['descricao'];
    $fundador = $post['fundador'];
    $setor = $post['setor'];
    $endereco = $post['endereco'];
    $contato = $post['contato'];
    $website = $post['website'];
    $emailStartup = $post['emailStartup'];

    $query = "SELECT nomeStartup FROM startups WHERE id = $startup_id";
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
    <title>Detalhes da Startup</title>
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

    
            <div class="title">

                <h1> <?php echo $startupName; ?> </h1>
                <h3> <?php echo $setor; ?> </h3>

            </div>

            <p> <?php echo $descricao; ?> </p>
                <p> Endereco: <?php echo $endereco; ?> </p>
                <p> Fundador(es): <?php echo $fundador; ?> </p>
                <p> Site: <?php echo $website; ?></p>
                <p> Email de contato: <?php echo $emailStartup; ?></p>
                <p> Número de contato: <?php echo $contato; ?></p>
            <a href="homePage.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

        


</body>
</html>