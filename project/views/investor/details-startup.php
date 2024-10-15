<?php
include "../../model/investor.php";
include "../../database/database.php"; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $startupDetails = detailsStartup($conn, $id);

    if ($startupDetails) {
        $startup_id = $startupDetails['id'];
        $nomeStartup = $startupDetails['nomeStartup'];
        $descricao = $startupDetails['descricao'];
        $fundador = $startupDetails['fundador'];
        $setor = $startupDetails['setor'];
        $endereco = $startupDetails['endereco'];
        $contato = $startupDetails['contato'];
        $website = $startupDetails['website'];
        $emailStartup = $startupDetails['emailStartup'];
    } else {
        echo "<p>Erro: Post não encontrado.</p>";
        exit;
    }
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
    <title>Investor Startup Details</title>
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

                <h1> <?php echo $nomeStartup; ?> </h1>
                <h3> <?php echo $setor; ?> </h3>

            </div>

            <p> <?php echo $descricao; ?> </p>
            <p> Endereco: <?php echo $endereco; ?> </p>
            <p> Fundador(es): <?php echo $fundador; ?> </p>
            <p> Site: <?php echo $website; ?></p>
            <p> Email de contato: <?php echo $emailStartup; ?></p>
            <p> Número de contato: <?php echo $contato; ?></p>
            
    </div>

    <div class="container">
        <h1 class="form-group"> Se interessou por essa startup? Entre em contato com ela! </h1>
        <form action="../../controllers/investor/contact-startup.php" method="post">
            <input type="hidden" name="startup-id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nome"> Nome </label>
                <input type="text" placeholder="Seu nome..." name="nome" class="form-control">
            </div>
            <div class="form-group">
                <label for="email"> Email </label>
                <input type="email" placeholder="Seu email..." name="email" class="form-control">
            </div>
            <div class="form-btn form-group">
                <label for="assunto"> Assunto </label>
                <input type="text" placeholder="Assunto" name="assunto" class="form-control">
            </div>
            <div class="form-btn form-group">
                <label for="mensagem"> Mensagem </label>
                <textarea name="mensagem" class="form-control" placeholder="Corpo do seu email"></textarea>
            </div>

            <div class="form-btn form-group">
                <button type="submit" name="send-email" class="btn btn-primary"> Enviar email! </button>
            </div>
                    
        </form>

        <?php

            if (isset($_GET["email"])) {
                if($_GET["email"] == "error") {
                    echo "<div class='alert alert-success'> Houve um erro no envio do seu email! </div>";
                } else if($_GET["email"] == "enviado") {
                    echo "<div class='alert alert-success'> Email enviado com sucesso! </div>";
                }
            } 

        ?>

    </div>

    <div class="container">
        <a href="home.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>