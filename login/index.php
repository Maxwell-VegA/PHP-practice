<?php
    require "header.php";
?>
<br>

<form action="includes/login.inc.php" method="POST">
    <p>Username or E-mail:</p>
    <input type="text" name="mailuid">
    <p>Password:</p>
    <input type="password" name="pwd">
    <!-- <br> -->
    <button type="submit" name="login-submit">Login</button>
</form>

<a href="signup.php">Sign Up</a>

<form action="includes/logout.inc.php" method="GET">
    <button type="submit" name="logout-submit">Log Out</button>
</form>

<main>
    <p>You are logged in</p>
    <p>Log in or register</p>
</main>



<?php
    // require "footer.php";
?>


</body>
</html>