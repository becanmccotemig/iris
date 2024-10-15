<?php
include "../../model/investor.php";
include "../../database/database.php";


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $repeatPassword = $_POST["repeat_password"];

    editPassword($conn, $email, $oldPassword, $newPassword, $repeatPassword);


}











?>