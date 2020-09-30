<?php
    session_start();

    if(isset($_POST['newCategorySubmit'])) {
        require 'dbh.inc.php';
        $createdBy   =   $_SESSION['userUid'];
        $categoryRaw =   trim($_POST['newCategoryName']);
        $category    =   str_replace(" ", "-", $categoryRaw);
        // insert a dash on space
        $color       =   $_POST['newCategoryColor'];
        if (empty($category)) {
            header("Location: ../notes.php?error=emptyname");
            exit();
        }
        else {
            $sql = "INSERT INTO categories (createdBy, categoryName, color) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
               echo "SQL statement failed";
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $createdBy, $category, $color);
                mysqli_stmt_execute($stmt);
                header("Location: ../notes.php");
                exit();
            }
        }
    }
    else {
        header("Location: ../notes.php");
        exit();
    }