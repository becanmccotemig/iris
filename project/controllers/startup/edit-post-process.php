<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <?php
        require_once "../../database/database.php";
        session_start();

        if (isset($_SESSION["user"])) {
            header("Location: ../../views/startup/login.php");
            exit();
        }

        if (isset($_POST["submitEditPost"])) {
            $id = mysqli_real_escape_string($conn, $_POST["post_id"]);
            $titulo = mysqli_real_escape_string($conn, $_POST["post-title"]);
            $categoria = mysqli_real_escape_string($conn, $_POST["post-category"]);
            $autor = mysqli_real_escape_string($conn, $_POST["post-author"]);
            $desc = mysqli_real_escape_string($conn, $_POST["post-description"]);
            $corpo = mysqli_real_escape_string($conn, $_POST["post-body"]);
        
            if (empty($titulo) || empty($categoria) || empty($autor) || empty($desc) || empty($corpo)) {
                echo "<div class='alert alert-danger'>Todos os campos devem ser preenchidos</div>";
            } else {
                $sql = "UPDATE post SET post_title = ?, post_category = ?, post_author = ?, post_description = ?, post_body = ? WHERE id = ?";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $titulo, $categoria, $autor, $desc, $corpo, $id);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Informações atualizadas com sucesso.</div>";
                    echo "<div> Para sua segurança, refaça o login.<a href='logout.php'>Clique aqui</a> </div>";
                } else {
                    echo "<div class='alert alert-danger'>Erro ao atualizar informações.</div>";
                }
            }
        } else {
            header("Location: ../../views/startup/edit-post.php");
            exit();
        }
        ?>

</body>
</html>

