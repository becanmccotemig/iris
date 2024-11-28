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
    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/investor/header.css">
    <link rel="stylesheet" href="../../components/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/details-startup.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Startup Details</title>
</head>

<body>
    <?php
    include_once '../../components/investor/header.php';
    ?>
    <div class="container main-content ">
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

    <div class="container main-content">
        <h1 class="form-group form-title"> Se interessou por essa startup? Entre em contato com ela! </h1>
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
            <div class="form-group">
                <label for="assunto"> Assunto </label>
                <input type="text" placeholder="Assunto" name="assunto" class="form-control">
            </div>
            <div class="form-group">
                <label for="mensagem"> Mensagem </label>
                <textarea name="mensagem" class="form-control" placeholder="Corpo do seu email"></textarea>
            </div>

            <div class="form-btn form-group">
                <button type="submit" name="send-email" class="btn btn-primary"> Enviar email </button>
            </div>

        </form>

        <?php

        if (isset($_GET["email"])) {
            if ($_GET["email"] == "error") {
                echo "<div class='alert alert-danger'> Houve um erro no envio do seu email! </div>";
            } else if ($_GET["email"] == "enviado") {
                echo "<div class='alert alert-success'> Email enviado com sucesso! </div>";
            }
        }

        ?>

    </div>

    <a href="home.php" class="btn btn-back mt-3">Voltar</a>

    <?php
    include_once '../../components/investor/footer.php';
    ?>
</body>

</html>