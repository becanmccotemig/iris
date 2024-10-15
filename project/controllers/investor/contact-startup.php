<?php

include "../../model/investor.php";
include "../../database/database.php"; 

if (isset($_POST["send-email"])) {
    $userEmail = $_POST["email"];
    $userMessage = $_POST["mensagem"];
    $userSubject = $_POST["assunto"];
    $userName = $_POST["nome"];
    $startup_id = $_POST["startup-id"];

    contactStartup($conn, $userEmail, $userMessage, $userSubject, $userName, $startup_id);
} else {
    header("Location: login.php");
    exit();
}
?>
