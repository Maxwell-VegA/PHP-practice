<?php
    require 'dbh.inc.php';
    $currentUser = $_SESSION['userUid'];
    $showNotes = false;
    $sql = "SELECT id FROM notes WHERE createdBy='$currentUser';";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if ($row > 0) {
        $showNotes = true;
    }

    
    if ($showNotes) {
        if (!isset($_GET['note'])) {
            $idSelector = '0';
            $sign = ' > ';
        }
        else {
            $idSelector = $_GET['note'];
            $sign = ' = ';
        }
        if (!isset($_GET['categoryname'])) {
            $selection = "";
        }
        else {
            $selectedCategory = $_GET['categoryname'];
            $selection = " AND category = '" . $selectedCategory . "'";
        }
        $sql = "SELECT * FROM notes 
            WHERE createdBy = '$currentUser' 
            AND id" . $sign . $idSelector . $selection . ";";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $noteArr[] = $row;
            if ($row > 0) {
                $showNotes = true;
            }
            else $showNotes = false;
        }
    }