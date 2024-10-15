<?php
include "../../model/investor.php";
include "../../database/database.php"; 


if (isset($_POST["update"])) {

    if(isset($_POST["user_id"])) {
        $id = $_POST["user_id"];
        $full_name = mysqli_real_escape_string($conn, $_POST["Name"]);
        $email = mysqli_real_escape_string($conn, $_POST["Email"]); 

        if (empty($full_name) || empty($email)) {
            echo "<div class='alert alert-danger'>Todos os campos devem ser preenchidos</div>";
        } else {
            updateInfo($conn, $id, $email, $full_name);
        }
    } else {
        echo("AAAAAAAAAAAAAAAAAAAA");
    }
}