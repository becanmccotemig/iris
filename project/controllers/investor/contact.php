<?php
include "../../model/investor.php";
include "../../database/database.php";


if (isset($_POST["send-email"])) {

    $userEmail = $_POST["email"];
    $userMessage = $_POST["mensagem"];
    $userSubject = $_POST["assunto"];
    $userName = $_POST["nome"];

    contact($conn, $userEmail, $userMessage, $userSubject, $userName);
} else {
    header("Location: login.php");
    exit();
}
?>

