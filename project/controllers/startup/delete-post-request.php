<?php
session_start();
require_once "../../database/database.php";
if (isset($_POST["delete-button"], $_POST["post_id"])) {
    if (!isset($_SESSION["id"])) {
        header("Location: ../../views/startup/login.php");
        exit();
    }
    
    echo("olaa");
   
    $post_id = intval($_POST["post_id"]);

    $stmt = $conn->prepare("DELETE FROM post WHERE id = ?");
    $stmt->bind_param("s", $post_id);

    if ($stmt->execute()) {
        header("Location: ../../views/startup/index.php?postDelete=deletado");
        exit();
    } else {
        echo ("<h1> Ocorreu um erro, tente novamente </h1>");
    }
   
    
}
?>
