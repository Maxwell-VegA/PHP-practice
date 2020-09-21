<?php
    session_start();
    $auth = false;
    if (!isset($_SESSION['userId'])) {
        $auth = false;
    }
    else {
        $auth = true;
    }
    
    $adminPermissions = false;
    if (!isset($_SESSION['userClass'])) {}
    else {
        if($_SESSION['userClass'] === 0) {
            $adminPermissions = false;
        }
        elseif($_SESSION['userClass'] === 1) {
            $adminPermissions = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Practice</title>
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<nav>
    <div class="nav-container">
<?php 
    ?>
    <a href="login.php">Home</a>
    <?php
    if ($auth === false) {
        ?>
        <a href="signup.php">Sign Up</a>
        <?php
    }
    elseif ($auth === true) {
        ?>
        <a href="todo.php">To-Do</a>
        <a href="notes.php">Notes</a>
        <!-- <a href="profile.php">Profile</a> -->
        <form action="includes/logout.inc.php" method="POST">
            <button type="submit" name="logout-submit">Log Out</button>
        </form>   
        <?php
        if ($adminPermissions === true) {
            echo "<span>User Class - 1</span>";
        }
        else {
            echo "<span>User Class - 0</span>";
        }
    }  
?>
    </div>
</nav>