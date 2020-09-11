<?php
    require "header.php";
?>

<form action="includes/signup.inc.php" method="POST">
    <p>Username:</p>
    <input type="text"      name="uid">
    <p>E-mail:</p>
    <input type="text"      name="email">
    <p>Password:</p>
    <input type="password"  name="pwd">
    <p>Re-enter password:</p>
    <input type="password"  name="re-pwd">
    <br>
    <br>
    <button type="submit"   name="signup-submit">Create Account</button>
</form>

<!-- The second pwd field only pops up after the minimum seven characters have been entered into the first one -->