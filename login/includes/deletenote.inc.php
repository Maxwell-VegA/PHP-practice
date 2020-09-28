<?php
    session_start();
    if(isset($_GET['note'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $id         =   $_GET['note'];
        $sql = "UPDATE notes SET visibility = 'deleted' WHERE createdBy = ? AND id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        }
        else {
            mysqli_stmt_bind_param($stmt, "si", $createdBy, $id);
            mysqli_stmt_execute($stmt);
            if (isset($_GET['update'])) {
                header("Location: ../notes.php?update=deleted");
                exit();
            }
            else {
                header("Location: ../archive.php");
                exit();
            }
        }
    }