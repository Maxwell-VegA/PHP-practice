<?php
    session_start();

    if(isset($_POST['category'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $category   =   $_POST['category'];
        $sql = "UPDATE notes SET category = 'unsorted', categoryColor = '#FF0000' WHERE category = '$category' AND createdBy = '$createdBy'";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        }
        else {
            mysqli_stmt_execute($stmt);
            $sql = "DELETE FROM categories WHERE categoryName = '$category' AND createdBy = '$createdBy'";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed";
            }
            else {
                mysqli_stmt_execute($stmt);
                require 'notes.inc.php';
            }
        }
    }