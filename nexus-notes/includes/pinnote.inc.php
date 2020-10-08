<?php
    session_start();
    
    if (isset($_GET['pinNote'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $noteId     =   $_GET['note'];
        $pinNote    =   $_GET['pinNote'];
        if ($pinNote === "yes" || $pinNote === "no") {
            $sql = "UPDATE notes SET pinned = '$pinNote', lastModified = now() WHERE id = $noteId AND createdBy = '$createdBy'";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed";
            }
            else {
                mysqli_stmt_execute($stmt);
                header("Location: ../notes.php");             
                exit();
            }
        }
    }