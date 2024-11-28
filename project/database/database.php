<?php

// $hostName = "localhost";
// $dbUser = "root";
// $dbPassword = "";
// $dbName = "iris";

// $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// if (!$conn) {
//     die("Something went wrong;");
// }

$hostName = "ywsa8i.easypanel.host";
$dbUser = "root";
$dbPassword = "MYSQLroot8110@yow";
$dbName = "iris";
$dbPort = 7777;

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName, $dbPort);

if (!$conn) {
    die("Something went wrong;");
}

?>
