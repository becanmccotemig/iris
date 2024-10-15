
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Edit Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <h1 class="form-group"> Redefinir Senha </h1>

        <form action="../../controllers/startup/password.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Senha antiga" name="old_password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Nova senha" name="new_password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repetir nova senha:">
            </div>
            <div class="form-btn form-group">
                <input type="submit" value="Redefinir" name="login" class="btn btn-primary">
            </div>
        </form>
        
        <div>
            <p> Não possui conta? <a href="registration.php"> Criar conta </a></p>
        </div>
        <div>
            <p> Já possui conta? <a href="login.php">Login</a></p>
        </div>

        <?php

            if (isset($_GET["password"])) {
                if($_GET["password"] == "incorrect") {
                    echo "<div class='alert alert-danger'> Senha anterior incorreta </div>";
                } else if($_GET["password"] == "same") {
                    echo "<div class='alert alert-danger'> Nova senha não pode ser igual a antiga </div>";
                } else if($_GET["password"] == "size") {
                    echo "<div class='alert alert-danger'> Nova senha deve possuir 8 ou mais caracteres </div>";
                } else if($_GET["password"] == "different"){
                    echo "<div class='alert alert-danger'> Senhas não conferem </div>";
                } else if($_GET["password"] == "updated") {
                    echo "<div class='alert alert-danger'> Senha editada com sucesso </div>";
                } else if($_GET["password"] == "error") {
                    echo "<div class='alert alert-danger'> Erro ao editar sua senha, tente novamente! </div>";
                }
            }

            if (isset($_GET["email"])) {
                if($_GET["email"] == "error")  {
                    echo "<div class='alert alert-danger'>Email incorreto ou inválido </div>";
                }
            }

            
        ?>
    </div>
</body>
</html>