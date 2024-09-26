<?php

session_start();
session_destroy();
header("Location: ../../views/investor/login.php");

?>