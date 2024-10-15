<?php
include "../../model/investor.php";
include "../../database/database.php";

if (isset($_POST["login"]))  {
    $email = $_POST["email"];
    $password = $_POST["password"];

    login($conn, $email, $password);
}