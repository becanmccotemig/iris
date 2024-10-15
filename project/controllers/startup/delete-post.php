<?php
include "../../model/post.php";
include "../../database/database.php";

session_start();

if (isset($_POST["delete-button"], $_POST["post_id"])) {
    if (!isset($_SESSION["id"])) {
        header("Location: ../../views/startup/login.php?session=error");
        exit();
    }
    $post_id = intval($_POST["post_id"]);

    deletePost($conn, $post_id);

}