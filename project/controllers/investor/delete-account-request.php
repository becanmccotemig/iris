<?php
include "../../model/investor.php";
include "../../database/database.php";

session_start();

if (isset($_POST["delete-button"], $_POST["user_id"])) {
    if (!isset($_SESSION["id"], $_SESSION["user"], $_SESSION["full_name"])) {
        header("Location: ../../views/investor/login.php");
        exit();
    }

    $user_id_to_delete = intval($_POST["user_id"]);
    var_dump($user_id_to_delete);
        
    $current_user_id = intval($_SESSION["id"]);
    if ($user_id_to_delete !== $current_user_id) {
        header("Location: ../../views/investor/index.php"); 
    }

    deleteAccount($conn, $user_id_to_delete);

}
?>
