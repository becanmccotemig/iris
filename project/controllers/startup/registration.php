<?php
include "../../model/startup.php";
include "../../database/database.php";


if (isset($_POST["register"])) {
    $nomeStartup = $_POST["startupName"];
    $descricao = $_POST["descricao"];
    $criador = $_POST["criador"];
    $areaAtuacao = $_POST["area"];
    $endereco = $_POST["endereco"];
    $contato = $_POST["contato"];
    $link = $_POST["link"];
    $emailStartup = $_POST["emailStartup"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($nomeStartup) OR empty($descricao) OR empty($criador) OR empty($areaAtuacao) OR empty($endereco) OR empty($contato) OR empty($link) OR empty($emailStartup) OR empty($password) OR empty($passwordRepeat)) {
        header("Location: ../../views/startup/registration.php?fields=empty");
        exit();
    } else if (!filter_var($emailStartup, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../views/startup/registration.php?email=invalid");
        exit();
    } else if(strlen($password) < 8) {
        header("Location: ../../views/startup/registration.php?password=invalid");
        exit();
    }  else if ($password !== $passwordRepeat) {
        header("Location: ../../views/startup/registration.php?password=different");
        exit();
    } else {
        register($conn, $nomeStartup, $descricao, $criador, $areaAtuacao, $endereco, $contato, $link, $emailStartup, $password, $passwordRepeat, $passwordHash);
    }
} else {
    header("Location: ../../views/startup/registration.php");
    exit();
}