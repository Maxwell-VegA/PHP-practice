<?php
    session_start();
    if(isset($_GET['note'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $id         =   $_GET['note'];
        if (!isset($_GET['restore'])){
            $sql = "UPDATE notes SET visibility = 'archived' WHERE createdBy = ? AND id = ?";
        }
        else {
            $sql = "UPDATE notes SET visibility = 'default' WHERE createdBy = ? AND id = ?";
        }
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        }
        else {
            mysqli_stmt_bind_param($stmt, "si", $createdBy, $id);
            mysqli_stmt_execute($stmt);
            if (isset($_GET['update'])) {
                header("Location: ../notes.php?update=archived");
                exit();
            }
            elseif (isset($_GET['restore'])) {
                header("Location: ../archivednotes.php?update=restored");
                exit();
            }
            else {
                header("Location: ../archive.php");
                exit();
            }
        }
    }