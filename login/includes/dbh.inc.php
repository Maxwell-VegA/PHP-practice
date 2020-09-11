<?php
// database handler
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "crud_practice";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}