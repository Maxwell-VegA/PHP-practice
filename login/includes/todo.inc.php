<br>
<?php
    require 'dbh.inc.php';
    $currentUser = $_SESSION['userUid'];
    $showPosts = false;
    $sql = "SELECT createdBy FROM todos WHERE createdBy='$currentUser';";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if ($row > 0) {
        $showPosts = true;
    }

    if ($showPosts) {
        $sql = "SELECT entryTitle, entryContent FROM todos WHERE createdBy='$currentUser';";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            $titlesAndContents[] = $row;
        }
    }



