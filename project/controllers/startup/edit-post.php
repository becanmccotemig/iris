<?php
include "../../model/post.php";
include "../../database/database.php";

session_start();

if (isset($_SESSION["user"])) {
    header("Location: ../../views/startup/login.php");
    exit();
}

if (isset($_POST["edit-post"])) {
    $post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
    $titulo = mysqli_real_escape_string($conn, $_POST["post-title"]);
    $categoria = mysqli_real_escape_string($conn, $_POST["post-category"]);
    $autor = mysqli_real_escape_string($conn, $_POST["post-author"]);
    $desc = mysqli_real_escape_string($conn, $_POST["post-description"]);
    $corpo = mysqli_real_escape_string($conn, $_POST["post-body"]);

    if (empty($titulo) || empty($categoria) || empty($autor) || empty($desc) || empty($corpo)) {
        header("Location: ../../views/startup/edit-post.php?fields=empty&post_id=$post_id");
        exit(); 
    } else {
        updateInfo($conn, $post_id, $titulo, $categoria, $autor, $desc, $corpo);
    }



}