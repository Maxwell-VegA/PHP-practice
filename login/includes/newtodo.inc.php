<?php
session_start();

if (isset($_POST['createEntry'])) {
    require 'dbh.inc.php';
    $createdBy  =   $_SESSION['userUid'];
    $title      =   $_POST['entryTitle'];
    $content    =   $_POST['entryContent'];
    $completed  =   0;

    if (empty($title) || empty($content)) {
        header("Location: ../todo.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "INSERT INTO todos (createdBy, entryTitle, entryContent, completed) VALUES (?, ?, ?, $completed)";
        // initialise the prepaired statement
        $stmt = mysqli_stmt_init($conn);
        // prepare the statement
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        }
        else {
            // bind the data in place of the placeholders
            mysqli_stmt_bind_param($stmt, "sss", $createdBy, $title, $content);
            header("Location: ../todo.php");
            // Execute the statement
            mysqli_stmt_execute($stmt);
        }
    }   
}
else {
    header("Location: ../todo.php");
    exit();
}