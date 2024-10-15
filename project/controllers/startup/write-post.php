<?php
include "../../model/post.php";
include "../../database/database.php";

session_start();
if (isset($_POST["submit-post"], $_POST["user_id"])) {
    if (!isset($_SESSION["id"])) {
        header("Location: ../../views/startup/login.php");
        exit();
    } else {
        $startup_id = $_POST["user_id"];
        $post_title = $_POST["post-title"];
        $post_category = $_POST["post-category"];
        $post_author = $_POST["post-author"];
        $post_description = $_POST["post-description"];
        $post_body = $_POST["post-body"];

        if (empty($post_title) OR empty($post_category) OR empty($post_author) OR empty($post_description) OR empty($post_body)) {
            header("Location: ../../views/startup/write-post.php?fields=empty");
            exit();
        } else {
            writePost($conn, $startup_id, $post_title, $post_category, $post_author, $post_description, $post_body);
        }
    }
}