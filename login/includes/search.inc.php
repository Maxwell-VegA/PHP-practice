<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
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
    
    
    $input = trim($_POST['search']);
    $sql = "SELECT * FROM notes WHERE noteTitle LIKE '%$input%' AND (createdBy = '$currentUser' OR category = 'unsorted') AND visibility = 'default' ORDER BY pinned DESC, noteTitle ASC;";
    $stmt = mysqli_stmt_init($conn);
    // '%$input%'
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed";
    }
    else {
        // mysqli_stmt_bind_param($stmt);
        // mysqli_stmt_bind_param($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $noteArr[] = $row;
            if ($row > 0) {
                $showNotes = true;
                
            }
            else {
                $showNotes = false;
            }    
        }
    }
    // $result = mysqli_query($conn, $sql);
    // if(mysqli_num_rows($result) > 0) {
    //     while($row = mysqli_fetch_assoc($result)) {
    //         $noteArr[] = $row;
    //         // echo $noteArr[0]['noteTitle'];
    //         if ($row > 0) {
    //             $showNotes = true;
                
    //         }
    //         else {
    //             $showNotes = false;
    //         }    
    //     }
    // }
    // else {
    //     $notesFound = false;
    //     $showNotes = false;
    // }


