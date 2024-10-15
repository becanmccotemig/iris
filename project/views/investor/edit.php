<?php
session_start();
include "../../model/investor.php";
include "../../database/database.php"; 

if(isset($_POST['edit-info'])) {
    $id = $_POST['user_id'];
    $userInfo = getInfo($conn, $id);
    if($userInfo) {
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
    <title>Investor Edit Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="form-group">Editar Investidor</h1>
        <form action="../../controllers/investor/edit.php" method="post" enctype="multipart/form-data">
            <label>Edite as informações da sua Conta</label>
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="Name" placeholder="Nome" value="<?php echo isset($fullName) ? htmlspecialchars($fullName) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Email" placeholder="Email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </div>
            <div class="form-group form-btn">
                <button type="submit" name="update" class="btn btn-primary"> Atualizar informações </button>
            </div> 
            <p> Deseja redefinir sua senha? <a href="edit-password.php"> Redefinir senha </a></p>
        </form>
    </div>
</body>
</html>
