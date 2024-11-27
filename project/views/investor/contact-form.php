<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/header/investor/header.css">
    <link rel="stylesheet" href="../../components/header/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/contact-form.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <title>Investor Startup Contact</title>
</head>

<body>
    <?php
    include_once '../../components/header/investor/header.php';
    ?>
    <div class="container main-content">

        <h1 class="form-group"> Entre em contato conosco! </h1>
        <form class="form-container" action="../../controllers/investor/contact.php" method="post">
            <div class="form-group">
                <label for="nome"> Nome </label>
                <input type="text" placeholder="Seu nome" name="nome" class="form-control">
            </div>
            <div class="form-group">
                <label for="email"> Email </label>
                <input type="email" placeholder="Seu email" name="email" class="form-control">
            </div>
            <div class="form-btn form-group">
                <label for="assunto"> Assunto </label>
                <input type="text" placeholder="Assunto" name="assunto" class="form-control">
            </div>
            <div class="form-btn form-group">
                <label for="mensagem"> Mensagem </label>
                <textarea name="mensagem" class="form-control" placeholder="Sua mensagem "></textarea>
            </div>

            <div class="form-btn form-group">
                <button type="submit" name="send-email" class="btn btn-primary"> Enviar email! </button>
            </div>

        </form>

        <?php
        if (isset($_GET["email"])) {
            if ($_GET["email"] == "enviado") {
                echo "<div class='alert alert-success'> Seu email foi enviado com sucesso para nossa equipe! </div>";
            }
        }
        ?>
    </div>

    <?php
    include_once '../../components/header/investor/footer.php';
    ?>
</body>

</html>