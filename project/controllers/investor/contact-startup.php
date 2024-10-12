<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../../vendor/autoload.php';
require("../../database/database.php");

$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPDebug = 0; // Desabilitar depuração
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'sofia.fernandesfs4@gmail.com';
$mail->Password = 'ovjl zihd halz bbyc';

if (isset($_POST["send-email"])) {
    $userEmail = $_POST["email"];
    $userMessage = $_POST["mensagem"];
    $userSubject = $_POST["assunto"];
    $userName = $_POST["nome"];
    $startup_id = $_POST["startup-id"];

    $stmt = $conn->prepare("SELECT * FROM startups WHERE id = ?");
    $stmt->bind_param("s", $startup_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $startup = $result->fetch_assoc();

        if ($startup) {
            $email_startup = $startup['emailStartup'];
        } else {
            echo 'Startup não encontrada.';
            exit();
        }
    } else {
        echo 'Erro na execução da consulta.';
        exit();
    }
    $name_startup = $startup['nomeStartup'];

    $default_message = "<p> Ola, $name_startup, um investidor demonstrou interesse na sua startup! </p>";
    $default_message .= "<p> Dados do interessado: </p>";
    $default_message .= "<p> Nome: $userName </p>";
    $default_message .= "<p> Email: $userEmail </p>";
    $default_message .= "<p> Abaixo, o investidor lhe enviou uma mensagem para iniciarem esse primeiro contato! Caso esteja interessado, você poderá entrar em contato com ele através do email acima descrito! </p>";
    $default_message .= "<p> Mensagem: </p>";
    $default_message .= "<p> $userMessage </p>";
 
    $message = $default_message;
    $subject = $userSubject;
    $mail->msgHTML($message);

    // Definindo o remetente como o email do usuário
    $mail->setFrom('sofia.fernandesfs4@gmail.com', 'Sofia'); // Email da conta autenticada
    $mail->addReplyTo($userEmail, $userName); // Email do usuário para resposta
    $mail->addAddress($email_startup);

    $mail->Subject = $subject;

    

    if (!$mail->send()) {
        exit();
    } else {
        header("Location: ../../views/investor/index.php?email=emailenviado");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
