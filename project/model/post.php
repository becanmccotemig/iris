<?php
include "../../database/database.php";


function deletePost($conn, $post_id)
{
    $stmt = $conn->prepare("DELETE FROM post WHERE id = ?");
    $stmt->bind_param("s", $post_id);

    if ($stmt->execute()) {
        header("Location: ../../views/startup/index.php?postDelete=deletado");
        exit();
    } else {
        header("Location: ../../views/startup/index.php?postDelete=error");
        exit();
    }

}

function writePost($conn, $startup_id, $post_title, $post_category, $post_author, $post_description, $post_body)
{
    $sql = "INSERT INTO post (post_title, post_category, post_author, post_description, post_body, startup_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssi", $post_title, $post_category, $post_author, $post_description, $post_body, $startup_id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../../views/startup/index.php?publicar=publicado");
            exit();
        } else {
            header("Location: ../../views/startup/write-post.php?post=error");
            exit();
        }
    } else {
        header("Location: ../../views/startup/index.php?post=error");
        exit();
    }
}

function detailsPost($conn, $id)
{
    $query = "SELECT p.*, s.nomeStartup FROM post p JOIN startups s ON p.startup_id = s.id WHERE p.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getInfo($conn, $post_id)
{
    $query = "SELECT * FROM post WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateInfo($conn, $post_id, $titulo, $categoria, $autor, $desc, $corpo)
{
    $query = "UPDATE post SET post_title = ?, post_category = ?, post_author = ?, post_description = ?, post_body = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $titulo, $categoria, $autor, $desc, $corpo, $post_id);
    if ($stmt->execute()) {
        header("Location: ../../views/startup/index.php?post=updated");
        exit();
    } else {
        header("Location: ../../views/investor/edit.php?update=notUpdated");
        exit();
    }
}