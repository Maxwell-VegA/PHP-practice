<?php


if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../login.php?error=emptyfields&mailuid=");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
                elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    // This is where you would add permissions 
                    // For example
                    // $_SESSION['userClass'] = $row['classUsers'];
                    // I assume later it would involve an
                    // if ($_SESSION['userClass'] == "admin") {do something}
                    header("Location: ../login.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            } 
            else {
                header("Location: ../login.php?error=nouser");
            }
        }
    }
}
else {
    header("Location: ../login.php");
}


// currently the script does give away weather a user or email actually exists by saying wrong pwd 
// perhaps it shouldn't