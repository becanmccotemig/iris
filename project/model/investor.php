<?php
include "../../database/database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '../../vendor/autoload.php';


function register($conn, $fullName, $email, $passwordHash) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        echo "<div class='alert alert-danger'> Email já registrado! <div>";
    } else {
        $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);

        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt,"sss", $fullName, $email, $passwordHash);
            if(mysqli_stmt_execute($stmt)) {
                header("Location: ../../views/investor/login.php?cadastro=cadastrado");
                exit();
            }
        } else {
            die("Algo deu errado");
        }
    }
}

function login($conn, $email, $password) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user)  {
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION['id'] = $user['id']; // Armazena o ID do usuário na sessão
            $_SESSION['user'] = $user['email']; // Armazena o email do usuário na sessão
            $_SESSION['full_name'] = $user['full_name']; // Armazena o nome completo do usuário na sessão
            header("Location: ../../views/investor/index.php");
            die();
        } else {
            echo "<div class='alert alert-danger'> Senha incorreta </div>";
        }
    } else {
        echo "<div class='alert alert-danger'> Email incorreto ou inválido </div>";
    }
}

function deleteAccount($conn, $user_id_to_delete) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id_to_delete);
    if($stmt->execute()){
        header("Location: ../../views/investor/login.php?delete=deletado");
        exit(); 
    } else {
        die("Algo deu errado ao preparar a declaração SQL");
    }
}

function contact($conn, $userEmail, $userMessage, $userSubject, $userName) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; // ou 587
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'sofia.fernandesfs4@gmail.com';
    $mail->Password = 'ovjl zihd halz bbyc';

    $message = '<p>' . $userMessage . '</p>';
    $subject = $userSubject;

    $mail->setFrom($userEmail, $userName);
    $mail->addReplyTo($userEmail, $userName);
    
    $mail->addAddress('sofia.fernandesfs4@gmail.com');
    
    $mail->Subject = $subject;
    
    $mail->msgHTML($message);

    if(!$mail->send()) {
        echo 'Erro ao enviar o e-mail: '. $mail->ErrorInfo;
        exit();
    } else {
        header("Location: ../../views/investor/contact-form.php?email=enviado");
        exit(); 
    }
}

function detailsPost($conn, $id) {
    $query = "SELECT p.*, s.nomeStartup AS startup_name 
              FROM post p 
              LEFT JOIN startups s ON p.startup_id = s.id 
              WHERE p.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function detailsStartup($conn, $id) {
    $query = "SELECT * FROM startups WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();

}

function getInfo($conn, $id) {
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateInfo($conn, $id, $email, $full_name) {
    $query = "UPDATE users SET full_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $full_name, $email, $id);
    if($stmt->execute()) {
        session_start();
        session_destroy();
        header("Location: ../../views/investor/login.php?update=updated");
        exit();
    } else {
        header("Location: ../../views/investor/edit.php?update=notUpdated");
        exit();
    }
}

function editPassword($conn, $email, $oldPassword, $newPassword, $repeatPassword) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (!password_verify($oldPassword, $user["password"])) {
            header("Location: ../../views/investor/edit-password.php?password=incorrect");
            exit();
        } else if (password_verify($newPassword, $user["password"])) {
            header("Location: ../../views/investor/edit-password.php?password=same");
            exit();
        } else if (strlen($newPassword) < 8 || strlen($repeatPassword) < 8) {
            header("Location: ../../views/investor/edit-password.php?password=size");
            exit();
        } else if ($newPassword!==$repeatPassword) {
            header("Location: ../../views/investor/edit-password.php?password=different");
            exit();
        } else {
            $sql = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

                if (mysqli_stmt_execute($stmt)) {
                    session_start();
                    session_destroy();
                    header("Location: ../../views/investor/login.php?password=updated");
                    exit();
                } else {
                    header("Location: ../../views/investor/edit-password.php?password=error");
                    exit();
                }
            }
        }
    } else {
        header("Location: ../../views/investor/edit-password.php?email=error");
        exit();
    }
}


function getStartups($conn) {
    $query = "SELECT * FROM startups";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $startups = [];
    while ($row = $result->fetch_assoc()) {
        $startups[] = $row;
    }

    return $startups; 
}

function getPosts($conn) {
    $query = "SELECT * FROM post";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }

    return $posts; 
}

function contactStartup($conn, $userEmail, $userMessage, $userSubject, $userName, $startup_id) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; // ou 587
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'sofia.fernandesfs4@gmail.com';
    $mail->Password = 'ovjl zihd halz bbyc';

    
    $stmt = $conn->prepare("SELECT * FROM startups WHERE id = ?");
    $stmt->bind_param("s", $startup_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $startup = $result->fetch_assoc();

        if ($startup) {
            $email_startup = $startup['emailStartup'];
            $name_startup = $startup['nomeStartup'];
        } else {
            echo 'Startup não encontrada.';
            exit();
        }
    } else {
        header("Location: ../../views/investor/details-startup.php?email=error&id=$startup_id");
        exit();
    }

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

    $mail->setFrom('sofia.fernandesfs4@gmail.com', 'Sofia'); // Email da conta autenticada
    $mail->addReplyTo($userEmail, $userName); // Email do usuário para resposta
    $mail->addAddress($email_startup);

    $mail->Subject = $subject;

    if (!$mail->send()) {
        header("Location: ../../views/investor/details-startup.php?email=error&id=$startup_id");
        exit();
    } else {
        header("Location: ../../views/investor/details-startup.php?email=enviado&id=$startup_id");
        exit();
    }

}