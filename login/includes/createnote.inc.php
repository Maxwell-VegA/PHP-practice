<?php
    session_start();
    
    if(isset($_POST['createNote'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $title      =   trim($_POST['noteTitle']);
        $text       =   trim($_POST['noteText']);
        $subtext    =   trim($_POST['noteSubtext']);
        $raw        =   $_POST['categoryAndColor'];
        $rawProc    =   explode(',',$raw);
        $category   =   $rawProc[0];
        $color      =   $rawProc[1];

        if (empty($title) && empty($text) && empty($subtext)) {
            $sql = "INSERT INTO notes (createdBy, noteTitle, noteText, noteSubText, created, lastModified, category, categoryColor, visibility, pinned) 
                    VALUES (?, 'New Note', '', '', now(), now(), ?, ?, 'default', 'no')";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
               echo "SQL statement failed";
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $createdBy, $category, $color);
                mysqli_stmt_execute($stmt);
                header("Location: ../fullnote.php?note=new");
                exit();
            }
        }
        elseif (empty($title) && (!empty($text) || !empty($subtext))) {
            $sql = "INSERT INTO notes (createdBy, noteTitle, noteText, noteSubText, created, lastModified, category, categoryColor, visibility, pinned) 
                    VALUES (?, 'New Note', ?, ?, now(), now(), ?, ?, 'default', 'no')";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
               echo "SQL statement failed";
            }
            else {
                mysqli_stmt_bind_param($stmt, "sssss", $createdBy, $text, $subtext, $category, $color);
                mysqli_stmt_execute($stmt);
                header("Location: ../notes.php");
                exit();
            }
        }
        else {
            $sql = "INSERT INTO notes (createdBy, noteTitle, noteText, noteSubText, created, lastModified, category, categoryColor, visibility, pinned) 
                    VALUES (?, ?, ?, ?, now(), now(), ?, ?, 'default', 'no')";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
               echo "SQL statement failed";
            }
            else {
                mysqli_stmt_bind_param($stmt, "ssssss", $createdBy, $title, $text, $subtext, $category, $color);
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