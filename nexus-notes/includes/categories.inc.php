<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require 'dbh.inc.php';
    $currentUser = $_SESSION['userUid'];
    $showCategories = false;
    $sql = "SELECT id FROM categories WHERE createdBy='$currentUser' OR categoryName = 'unsorted';";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if ($row > 0) {
        $showCategories = true;
    }

    if ($showCategories && empty($categoryArr)) {
        $sql = "SELECT * FROM categories WHERE createdBy = '$currentUser' OR categoryName = 'unsorted' ORDER BY FIELD (categoryName, 'unsorted') DESC, categoryName ASC;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $categoryArr[] = $row;
        }
    }