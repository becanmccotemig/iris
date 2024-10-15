<?php
include "../../model/startup.php";
include "../../database/database.php"; 

session_start();

if (isset($_SESSION["user"])) {
    header("Location: ../../views/startup/login.php");
    exit();
}

if (isset($_POST["update"]))  {
    $nomeStartup = mysqli_real_escape_string($conn, $_POST["startupName"]);
    $descricao = mysqli_real_escape_string($conn, $_POST["descricao"]);
    $criador = mysqli_real_escape_string($conn, $_POST["criador"]);
    $areaAtuacao = mysqli_real_escape_string($conn, $_POST["area"]);
    $endereco = mysqli_real_escape_string($conn, $_POST["endereco"]);
    $contato = mysqli_real_escape_string($conn, $_POST["contato"]);
    $link = mysqli_real_escape_string($conn, $_POST["link"]);
    $emailStartup = mysqli_real_escape_string($conn, $_SESSION["emailStartup"]);
    $newEmail = mysqli_real_escape_string($conn, $_POST["newEmail"]);

    if (empty($nomeStartup) || empty($newEmail) || empty($descricao) || empty($criador) || empty($areaAtuacao) || empty($endereco) || empty($contato) || empty($link)) {
        header("Location: ../../views/startup/edit.php?fields=empty");
        die();
    } else {
        updateInfo($conn, $nomeStartup, $descricao, $criador, $areaAtuacao, $endereco, $contato, $link, $emailStartup, $newEmail);
    }
}