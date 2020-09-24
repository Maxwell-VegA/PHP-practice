<?php
    session_start();

    if(isset($_POST['saveNote'])) {
        require 'dbh.inc.php';
        $createdBy  =   $_SESSION['userUid'];
        $noteId     =   $_GET['note'];
        if (isset($_POST['noteText']))      {$text       =   trim($_POST['noteText']);}
        else {$text = "";}        
        if (isset($_POST['noteSubText']))   {$subtext    =   trim($_POST['noteSubText']);}
        else {$subtext = "";}
        $title      =   trim($_POST['noteTitle']);


    if (empty($title)) {
            header("Location: ../fullnote.php?note=" . $_GET['note'] . "&error=emptytitle&notetext=" . $text . "&notesubtext=" . $subtext);
            exit();
        }
    }
    else {
        $raw        =   $_POST['categoryAndColor'];
        $rawProc    =   explode(',',$raw);
        $category   =   $rawProc[0];
        $color      =   $rawProc[1];
        $sql = "UPDATE notes SET noteTitle = $title, noteText = $text, noteSubText = $subtext, lastModifier = now(), category = $category, color = $categoryColor WHERE id = $noteId";
        // (createdBy, noteTitle, noteText, noteSubText, created, lastModified, category, categoryColor) VALUES (?, ?, ?, ?, now(), now(), ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        }
        else {
            echo "hello";
             ?>
            <script>
            alert("SAD")
            </script>
            <?php
            mysqli_stmt_bind_param();
            mysqli_stmt_execute($stmt);
            header("Location: ../notes.php");

           
        }
    }