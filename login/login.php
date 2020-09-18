<?php
    require "header.php";
?>
<br>

<?php
if (isset($_GET['signup'])) {
        if ($_GET['signup'] == 'success') {
            echo "Signup successful!";
        }
    }
?>
<?php
    if ($auth === true) {
        ?>
        <form action="includes/logout.inc.php" method="POST">
            <button type="submit" name="logout-submit">Log Out</button>
        </form>   
        <?php
    }
    else {
        ?>
        <form action="includes/login.inc.php" method="POST">
            <p>Username or E-mail:</p>
            <input type="text" name="mailuid">
            <p>Password:</p>
            <input type="password" name="pwd">
            <!-- <br> -->
            <button type="submit" name="login-submit">Login</button>
        </form>
        
        <a href="signup.php">Sign Up</a>      
        <?php
    }
?>




<main>
    <?php
    if ($auth === true) {
        echo '<p>Welcome ' . $_SESSION['userUid'] . '!</p>';
        
    }
    else {
        echo '<p>Log in or register</p>';
    }
    ?>

    
</main>



<?php
    require "footer.php";
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