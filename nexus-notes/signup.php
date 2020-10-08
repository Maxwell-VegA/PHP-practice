<?php
    require "header.php";
?>
<?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyfields') {
            echo "please fill in all fields";
        }
        elseif ($_GET['error'] == 'invalidemailuid') {
            echo "Invalid username and e-mail";
        }
        elseif ($_GET['error'] == 'invalidemail') {
            echo "Invalid e-mail";
        }
        elseif ($_GET['error'] == 'invaliduid') {
            echo "Invalid username";
        }
        elseif ($_GET['error'] == 'passwordcheck') {
            echo "passwords do not match";
        }
        elseif ($_GET['error'] == 'usertaken') {
            echo "username is already taken";
        }
    }
?>

<h1 id="signup-title">Sign Up</h1>
<form class="signup-form" action="includes/signup.inc.php" method="POST">
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
    <a href="login.php">Log in</a>      
</form>

<!-- The second pwd field only pops up after the minimum seven characters have been entered into the first one -->