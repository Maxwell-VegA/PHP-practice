<?php
    require "header.php";

    if (isset($_GET['signup'])) {
            if ($_GET['signup'] == 'success') {
                echo "Signup successful!";
            }
        }
?>


<div class="login-message">
    <?php
    if ($auth === true) {
        echo '<p>Welcome ' . $_SESSION['userUid'] . '!</p>';
        header("Location: ../notes.php");
 
    }
    else {
        echo '<p>Log in or register</p>';
    }
    ?>
</div>

<?php
    if ($auth === false) {
        ?>
            <div class="login-main">
                <form action="includes/login.inc.php" method="POST" autocomplete="off">
                    <p>Username or E-mail:</p>
                    <input type="text" name="mailuid">
                    <p>Password:</p>
                    <input type="password" name="pwd">
                    <br>
                    <button type="submit" name="login-submit">Login</button>
                    <a href="signup.php">Sign Up</a>      
                </form>
            </div>
        <?php
    }
?>




<!-- 
CREATE TABLE users (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    uidUsers TINYTEXT NOT NULL,
    emailUsers TINYTEXT NOT NULL,
    pwdUsers LONGTEXT NOT NULL,
	userClass BOOLEAN NOT NULL
);

CREATE TABLE todos (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    createdBy TINYTEXT NOT NULL,
    entryTitle TINYTEXT NOT NULL,
    entryContent LONGTEXT,
	completed BOOLEAN NOT NULL
);
 -->

<!-- 
    CREATE TABLE notes (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    createdBy TINYTEXT NOT NULL,
    noteTitle TINYTEXT NOT NULL,
    noteText LONGTEXT,
    noteSubText LONGTEXT,
	created DATETIME NOT NULL,
    lastModified DATETIME NOT NULL
);
 -->