<?php
session_start();

include("../../database/database.php");

if (!isset($_SESSION["id"], $_SESSION["nomeStartup"], $_SESSION["descricao"], $_SESSION["fundador"], $_SESSION["setor"], $_SESSION["endereco"], $_SESSION["contato"], $_SESSION["website"], $_SESSION["emailStartup"])) {
    header("Location: login.php");
    exit(); // Encerrar a execução para garantir que o código abaixo não seja executado
}

// Agora $_SESSION['id'], $_SESSION['user'] e $_SESSION['full_name'] contêm as informações do usuário
$user_id = $_SESSION["id"];
$nome_startup = $_SESSION["nomeStartup"];
$desc_startup = $_SESSION["descricao"];
$fund_startup = $_SESSION["fundador"];
$setor_startup = $_SESSION["setor"];
$end_startup = $_SESSION["endereco"];
$contato_startup = $_SESSION["contato"];
$site_startup = $_SESSION["website"];
$email_startup = $_SESSION["emailStartup"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/header/startup/header.css">
    <link rel="stylesheet" href="../../components/header/startup/footer.css">
    <link rel="stylesheet" href="../../design/startups/index.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Startup Index</title>
</head>

<body>
    <?php
    include_once '../../components/header/startup/header.php';
    ?>

    <div class="container main-content">
        <h1 class="title">Bem-vindo</h1>
        <h2 class="info-title">Informações da Startup:</h2>
        <p>Nome: <?php echo $nome_startup; ?></p>
        <p>Descrição: <?php echo $desc_startup; ?></p>
        <p>Fundador(es): <?php echo $fund_startup; ?></p>
        <p>Setor: <?php echo $setor_startup; ?></p>
        <p>Endereço: <?php echo $end_startup; ?></p>
        <p>Contato: <?php echo $contato_startup; ?></p>
        <p>Website: <?php echo $site_startup; ?></p>
        <p>Email: <?php echo $email_startup; ?></p>

        <div class="btns">
            <form class="redefinir" action="../../views/startup/edit-password.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <button type="submit" name="edit-password" class="btn btn-warning">Editar senha</button>
            </form>

            <a href="edit.php" class="btn btn-warning">Editar Info</a>

            <form class='deletar' action="delete-account.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <button type="submit" name="delete-button" class="btn btn-danger">Excluir conta</button>
            </form>

            <a href="../../controllers/startup/logout.php" class="btn btn-warning">Deslogar</a>
        </div>

        <form class="escrever" action="write-post.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <button type="submit" name="write-post" class="btn btn-primary"> Escrever um Post </button>
        </form>




        <?php
        if (isset($_GET["delete"])) {
            if ($_GET["delete"] == "error") {
                echo "<div class='alert alert-danger'> Ocorreu um erro ao deletar sua conta, tente novamente! </div>";
            }
        }
        ?>
        <section class="post-section">
            <h1> Seus posts! </h1>
        </section>

        <?php
        $query = "SELECT * FROM post WHERE startup_id = $user_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "<h5> Você ainda nao possui nenhum post! </h5>";
        } else {
            echo "<section class='post-container'> ";

            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['id'];
                $url = "details-post.php?id=" . urlencode($post_id);
                echo "
                        <div class='post'>
                            <h1> " . htmlspecialchars($row['post_title']) . "</h1>
                            <p> " . htmlspecialchars($row['post_description']) . " </p>
                            <a href='$url' class='btn btn-primary'>Ver mais</a>
                        </div>
                    ";
            }

            echo "</section>";
        }
        ?>
        <?php
        if (isset($_GET["publicar"])) {
            if ($_GET["publicar"] == "publicado") {
                echo "<div class='alert alert-success'> Post publicado com sucesso </div>";
            }
        }
        ?>

        <?php
        if (isset($_GET["post"])) {
            if ($_GET["post"] == "updated") {
                echo "<div class='alert alert-success'> Post editado com sucesso </div>";
            }
        }
        ?>

        <?php
        if (isset($_GET["postDelete"])) {
            if ($_GET["postDelete"] == "deletado") {
                echo "<div class='alert alert-success'> Post deletado com sucesso </div>";
            } else if ($_GET["postDelete"] == "error") {
                echo "<div class='alert alert-danger'> Erro ao deletar o post, tente novamente! </div>";
            }
        }
        ?>
    </div>
    <?php
    include_once '../../components/header/startup/footer.php';
    ?>
</body>

</html>