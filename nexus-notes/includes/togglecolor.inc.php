<?php
    session_start();
    require 'dbh.inc.php';
    $id             =   $_SESSION['userId'];
    $user           =   $_SESSION['userUid'];
    $currentMode    =   $_SESSION['darkmode'];
    if ($currentMode === 'd') {
        $toggleTo = 'l';
    }
    else {
        $toggleTo = 'd';
    }
    $sql = "UPDATE users SET darkmode = '$toggleTo' WHERE uidUsers = '$user' AND id = $id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed";
    }
    else {
        mysqli_stmt_execute($stmt);
        $_SESSION['darkmode'] = $toggleTo;
        header("Location: ../notes.php");             
        exit();
    }

