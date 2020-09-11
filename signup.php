<?php
    include_once 'functions.php';

    $first       = $_POST['first'];
    $last        = $_POST['last'];
    $email       = $_POST['email'];
    $uid         = $_POST['uid'];
    $password    = $_POST['password'];

    $userTemplate = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$password');";
    
    $addNewUser = mysqli_query($conn, $userTemplate);
    
    header("location: index.php");


