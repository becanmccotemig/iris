<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/vendor/autoload.php';

$mail = new PHPMailer();

// Desative a depuração SMTP
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; // ou 587
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'sofia.fernandesfs4@gmail.com';
$mail->Password = 'ovjl zihd halz bbyc';

if(isset($_POST["reset-request-submit"])) {

    $selector = bin2hex(random_bytes(8)); // binary to hex
    $token = random_bytes(32);

    $url = "http://localhost/iris/iris/project/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("Y-m-d H:i:s", strtotime("+30 minutes"));
    require "database.php";

    $userEmail = $_POST["email"];

    $sql  = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<div class='alert alert-danger'> Houve um erro </div>";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<div class='alert alert-danger'> Houve um erro </div>";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn); 

    //teste

    $message = '<p> Recebemos uma solicitação para alterar sua senha. O link para redefinri sua senha está abaixo, se você não solicitou isso pode ignorar este email </p>';
    $message .=  '<p> Link para redefinição de senha:  </br>';
    $message .=  '<a href="' . $url . '">' . $url . '</a> </p>';
    
    $subject = 'Redefina sua senha';

    $mail->setFrom('sofia.fernandesfs4@gmail.com', 'Sofia');
    $mail->addReplyTo('sofia.fernandesfs4@gmail.com', 'Sofia');
    $mail->addAddress($userEmail);
    $mail->Subject = $subject;
    $mail->msgHTML($message);

    if (!$mail->send()) {
        echo 'Erro ao enviar o e-mail: '. $mail->ErrorInfo;
        exit();
    } else {
        header("Location: reset-password.php?reset=success");
        exit(); // Adicione o exit() após o redirecionamento
    }

} else {
    header("Location: login.php");
    exit();
}

?>
