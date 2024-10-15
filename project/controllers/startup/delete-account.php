<?php
include "../../model/startup.php";
include "../../database/database.php";

session_start();


if (isset($_POST["delete-button"], $_POST["user_id"])) {
    if (!isset($_SESSION["id"])) {
        header("Location: ../../views/startup/login.php?login=false");
        exit();
    }
       
    $user_id_to_delete = intval($_POST["user_id"]);
    $current_user_id = intval($_SESSION["id"]);

    if ($user_id_to_delete !== $current_user_id) {
        header("Location: ../../views/startup/index.php?session=error"); 
    }

    deleteAccount($conn, $user_id_to_delete);
    
}