<?php
    session_start();
    $auth = false;
    if (isset($_SESSION['userId'])) {
        $auth = true;
    }
    else {
        $auth = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Practice</title>
    <style>
    * {
        background: black;
        color: white;
        font-family: monospace;
    }
    </style>
</head>
<body>
    


<a href="login.php">Home</a>
<!-- <a href="">Log In</a> -->
<a href="signup.php">Sign Up</a>
<!-- <a href=""></a> -->
<br>

