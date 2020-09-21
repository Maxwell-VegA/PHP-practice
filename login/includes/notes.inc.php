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

    // if (session_status() == PHP_SESSION_NONE) {
    //     session_start();
    // }
    if (isset($_POST['sort'])) {
        $orderBy = $_POST['sort'];
        ?>
        <script>
        alert("if path: ");
        alert(<?php $orderBy ?>);
        </script>
        <?php
        if ($orderBy === 0) {
            $displayOrder = "lastModified DESC";
        }
        elseif ($orderBy === 1) {
            $displayOrder = "created DESC";
        }
        elseif ($orderBy === 2) {
            $displayOrder = "created ASC";
        }
        elseif ($orderBy === 3) {
            $displayOrder = "noteTitle DESC";
        }
    }
    else {
         ?>
        <script>
        // alert("else path");
        </script>
        <?php
        $displayOrder = "lastModified DESC";
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
            AND id" . $sign . $idSelector . $selection .
            " ORDER BY " . $displayOrder . ";";
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