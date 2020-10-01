<?php
    session_start();

    if(isset($_POST['saveNote'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $noteId     =   $_GET['note'];
        $title      =   trim($_POST['noteTitle']);
        if (isset($_POST['noteText']))      {$text       =   trim($_POST['noteText']);}
        else {$text = "";}        
        if (isset($_POST['noteSubText']))   {$subtext    =   trim($_POST['noteSubText']);}
        else {$subtext = "";}
        if (empty($title)) {
                header("Location: ../fullnote.php?note=" . $_GET['note'] . "&error=emptytitle&notetext=" . $text . "&notesubtext=" . $subtext);
                exit();
            }
        else {
            $raw        =   $_POST['categoryAndColor'];
            $rawProc    =   explode(',', $raw);
            $category   =   $rawProc[0];
            $color      =   $rawProc[1];
            $sql = "UPDATE notes SET noteTitle = ?, noteText = ?, noteSubText = ?, lastModified = now(), category = ?, categoryColor = ? WHERE id = $noteId AND createdBy = '$createdBy'";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed";
            }
            else {
                mysqli_stmt_bind_param($stmt, "sssss", $title, $text, $subtext, $category, $color);
                mysqli_stmt_execute($stmt);
                header("Location: ../notes.php?update=sucess");             
            }
        }
    }
