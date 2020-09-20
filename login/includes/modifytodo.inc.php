<?php
    session_start();
    require 'dbh.inc.php';
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $item = $_GET['item'];
        $user = $_SESSION['userUid'];
        switch($action) {
            case "completed":
                $sql = "UPDATE todos 
                SET completed = 1
                WHERE id = ?
                AND createdBy = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $item, $user);
                mysqli_stmt_execute($stmt);
            break;
            case "incompleted":
                $sql = "UPDATE todos 
                SET completed = 0
                WHERE id = ?
                AND createdBy = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $item, $user);
                mysqli_stmt_execute($stmt);
            break;
            case "delete":
                $sql = "DELETE FROM todos 
                WHERE id = ?
                AND createdBy = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $item, $user);
                mysqli_stmt_execute($stmt);
            break;
            default:
                echo "switch error";
        }
    }



    
    header("Location: ../todo.php");
    exit();