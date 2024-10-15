<?php
session_start();
include "../../model/startup.php";
include "../../database/database.php"; 
if (isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$emailStartup = $_SESSION["emailStartup"];
$startup = getInfo($conn, $emailStartup);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startup Edit Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="form-group">Editar Startup</h1>
        <form action="../../controllers/startup/edit.php" method="post" enctype="multipart/form-data">
            <label>Edite as informações da sua Startup</label>
            <div class="form-group">
                <input type="text" class="form-control" name="startupName" placeholder="Nome" value="<?php echo htmlspecialchars($startup['nomeStartup']); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="newEmail" placeholder="Email" value="<?php echo htmlspecialchars($startup['emailStartup']); ?>">
            </div>
            <div class="form-btn form-group">
                <textarea name="descricao" class="form-control" placeholder="Use este campo para fazer uma descrição de sua Startup!"><?php echo htmlspecialchars($startup['descricao']); ?></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="criador" placeholder="Criador/es da Startup" value="<?php echo htmlspecialchars($startup['fundador']); ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="area" placeholder="Área de atuação" value="<?php echo htmlspecialchars($startup['setor']); ?>">
            </div>
            <div class="form-group">
                <textarea name="endereco" class="form-control" placeholder="Endereço onde sua startup está situada"><?php echo htmlspecialchars($startup['endereco']); ?></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="contato" placeholder="Número de contato" value="<?php echo htmlspecialchars($startup['contato']); ?>">
            </div>
            <div class="form-group">
                <input type="url" class="form-control" name="link" placeholder="Link do seu website ou portfólio" value="<?php echo htmlspecialchars($startup['website']); ?>">
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="imagem" placeholder="Logo da sua Startup">
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="update" class="btn btn-primary"> Atualizar informações </button>
            </div> 
            <p> Deseja redefinir sua senha? <a href="../password.php"> Redefinir senha </a></p>
        </form>

        <?php

            if (isset($_GET["update"])) {
                if($_GET["update"] == "notUpdated") {
                    echo "<div class='alert alert-danger'> Não foi possível fazer a atualização de sua informações, tente novamente! </div>";
                }
            }

            if (isset($_GET["fields"])) {
                if($_GET["fields"] == "empty") {
                    echo "<div class='alert alert-danger'>Todos os campos devem ser preenchidos </div>";
                }
            }
        ?>
    </div>
</body>
</html>
