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
    if (isset($_SESSION['userId'])) {
        echo '<p>You are logged in</p>';
    }
    else {
        echo '<p>Log in or register</p>';
    }
    ?>

    
</main>



<?php
    // require "footer.php";
?>


</body>
</html>

<!-- For now this is index but later this will become the login screen that you can navigate to from the home page which I haven't yet created -->