<?php
include "../../database/database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '../../vendor/autoload.php';


function register($conn, $nomeStartup, $descricao, $criador, $areaAtuacao, $endereco, $contato, $link, $emailStartup, $password, $passwordRepeat, $passwordHash)
{
    $sql = "SELECT * FROM startups WHERE emailStartup = '$emailStartup'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        header("Location: ../../views/startup/registration.php?email=error");
        exit();
    } else {
        $sql = "INSERT INTO startups (nomeStartup, descricao, fundador, setor, endereco, contato, website, emailStartup, password) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sssssssss", $nomeStartup, $descricao, $criador, $areaAtuacao, $endereco, $contato, $link, $emailStartup, $passwordHash);
            mysqli_stmt_execute($stmt);
            header("Location: ../../views/startup/registration.php?register=success");
            exit();
        } else {
            header("Location: ../../views/startup/registration.php?register=error");
            exit();
        }
    }

}

function login($conn, $email, $password)
{
    $sql = "SELECT * FROM startups WHERE emailStartup = '$email'";
    $result = mysqli_query($conn, $sql);
    $startup = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($startup) {
        if (password_verify($password, $startup["password"])) {
            session_start();
            $_SESSION['id'] = $startup['id']; // Armazena o ID do usuário na sessão
            $_SESSION['nomeStartup'] = $startup['nomeStartup'];
            $_SESSION['descricao'] = $startup['descricao'];
            $_SESSION['fundador'] = $startup['fundador'];
            $_SESSION['setor'] = $startup['setor'];
            $_SESSION['endereco'] = $startup['endereco'];
            $_SESSION['contato'] = $startup['contato'];
            $_SESSION['website'] = $startup['website'];
            $_SESSION['emailStartup'] = $startup['emailStartup'];
            header("Location: ../../views/startup/index.php");
            die();
        } else {
            header("Location: ../../views/startup/login.php?password=incorrect");
            die();
        }
    } else {
        header("Location: ../../views/startup/login.php?email=invalid");
        die();
    }

}

function deleteAccount($conn, $user_id_to_delete)
{
    $sql = "DELETE FROM startups WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id_to_delete);
        if (mysqli_stmt_execute($stmt)) {
            $sql = "DELETE FROM post WHERE startup_id = ?";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "i", $user_id_to_delete);
                if (mysqli_stmt_execute($stmt)) {
                    session_destroy();
                    header("Location: ../../views/startup/login.php?delete=deletado");
                    exit();
                } else {
                    header("Location: ../../views/startup/index.php?delete=error");
                    exit();
                }
            } else {
                header("Location: ../../views/startup/index.php?delete=error");
                exit();
            }
        } else {
            header("Location: ../../views/startup/index.php?delete=error");
            exit();
        }
    } else {
        header("Location: ../../views/startup/index.php?delete=error");
        exit();
    }
}

function getInfo($conn, $emailStartup)
{
    $query = "SELECT * FROM startups WHERE emailStartup = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emailStartup);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateInfo($conn, $nomeStartup, $descricao, $criador, $areaAtuacao, $endereco, $contato, $link, $emailStartup, $newEmail)
{
    $query = "UPDATE startups SET nomeStartup = ?, descricao = ?, fundador =  ?, setor =  ?, endereco =  ?, contato =  ?, website =  ?, emailStartup = ? WHERE emailStartup = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssss", $nomeStartup, $descricao, $criador, $areaAtuacao, $endereco, $contato, $link, $newEmail, $emailStartup);
    if ($stmt->execute()) {
        session_start();
        session_destroy();
        header("Location: ../../views/startup/login.php?update=updated");
        exit();
    } else {
        header("Location: ../../views/startup/edit.php?update=notUpdated");
        exit();
    }
}

function editPassword($conn, $email, $oldPassword, $newPassword, $repeatPassword)
{
    $sql = "SELECT * FROM startups WHERE emailStartup = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (!password_verify($oldPassword, $user["password"])) {
            header("Location: ../../views/startup/edit-password.php?password=incorrect");
            exit();
        } else if (password_verify($newPassword, $user["password"])) {
            header("Location: ../../views/startup/edit-password.php?password=same");
            exit();
        } else if (strlen($newPassword) < 8 || strlen($repeatPassword) < 8) {
            header("Location: ../../views/startup/edit-password.php?password=size");
            exit();
        } else if ($newPassword !== $repeatPassword) {
            header("Location: ../../views/startup/edit-password.php?password=different");
            exit();
        } else {
            $sql = "UPDATE startups SET password = ? WHERE emailStartup = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

                if (mysqli_stmt_execute($stmt)) {
                    session_start();
                    session_destroy();
                    header("Location: ../../views/startup/login.php?password=updated");
                    exit();
                } else {
                    header("Location: ../../views/startup/edit-password.php?password=error");
                    exit();
                }
            }
        }
    } else {
        header("Location: ../../views/startup/edit-password.php?email=error");
        exit();
    }
}

