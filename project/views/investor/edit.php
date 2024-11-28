<?php
session_start();
include "../../model/investor.php";
include "../../database/database.php";

if (isset($_POST['edit-info'])) {
    $id = $_POST['user_id'];
    $userInfo = getInfo($conn, $id);
    if ($userInfo) {
        $fullName = $userInfo['full_name'];
        $email = $userInfo['email'];
    } else {
        echo "<div class='alert alert-danger'>Usuário não encontrado.</div>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- // CSS -->
    <link rel="stylesheet" href="../../components/investor/header.css">
    <link rel="stylesheet" href="../../components/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/edit.css">
    <link rel="stylesheet" href="../../design/global/global.css">
    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Edit Info</title>
</head>

<body>
    <?php
    include_once '../../components/investor/header.php';
    ?>
    <div class="container main-content">
        <h1 class="title">Editar Investidor</h1>
        <form class="form-group" action="../../controllers/investor/edit.php" method="post"
            enctype="multipart/form-data">
            <label>Edite as informações da sua Conta</label>
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="Name" placeholder="Nome"
                    value="<?php echo isset($fullName) ? htmlspecialchars($fullName) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Email" placeholder="Email"
                    value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="update" class="btn btn-primary"> Atualizar informações </button>
            </div>
            <p> Deseja redefinir sua senha? <a href="edit-password.php"> Redefinir senha </a></p>
        </form>
    </div>
    <?php
    include_once '../../components/investor/footer.php';
    ?>
</body>

</html>