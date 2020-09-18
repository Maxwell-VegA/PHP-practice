<?php
    session_start();
    include_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>


<body>
<h1>HOME</h1>
<a href="contacts.php">contacts</a>
<br>
<br>
<form action="">
    <input type="text" name="num1" placeholder="Number 1">
    <input type="text" name="num2" placeholder="Number 2">
    <br>
    <select name="operator" id="">
        <option>None</option>
        <option>Add</option>
        <option>Subtract</option>
        <option>Multiply</option>
        <option>Divide</option>
    </select>
    <button action="" type="submit" name="submit" value="submit">
        Calculate
    </button>
</form>


<?php 
    if (isset($_GET['submit'])) {
        $result1 = $_GET['num1'];
        $result2 = $_GET['num2'];
        $operator = $_GET['operator'];
        switch ($operator) {
            case 'None':
                echo "ERROR";
            break;
            case 'Add':
                echo $result1 + $result2;
            break;
            case 'Subtract':
                echo $result1 - $result2;
            break;
            case 'Multiply':
                echo $result1 * $result2;
            break;
            case 'Divide':
                echo $result1 + $result2;
            break;
            default:
                echo "problem";

        }
    }
?>
<br>
<?php 
$dayOfWeek = date("w");
$today = 'unknown';

switch ($dayOfWeek) {
  case 1:
    $today = "Monday";
    break;
  case 2:
    $today = "Tuesday";
    break;
  case 3:
    $today = "Wednesday";
    break;
  case 4:
    $today = "Thursday";
    break;
  case 5:
    $today = "Friday";
    break;
  case 6:
    $today = "Saturday";
    break;
  case 0:
    $today = "Sunday";
    break;
}

echo $today;

?>
<br>
<br>
<?php

$_SESSION['username'] = 'mx-vega';



if (!isset($_SESSION['username'])) {
    echo "no user detected";
} else {
    echo "user: " . $_SESSION['username'];
}
?>
<br>
<br>
<?php
    $sql = "SELECT * FROM users;";
    $results = mysqli_query($conn, $sql);
    $resultsCheck = mysqli_num_rows($results);

    if ($resultsCheck > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            echo $row['user_uid'] . "<br>";
        }
    } else {
        echo "ResultsCheck returning false.";
    }
?>

<form action="signup.php" method="POST">
    <input type="text"      name="first"     placeholder="First Name">
    <br>
    <input type="text"      name="last"      placeholder="Last Name">
    <br>
    <input type="text"      name="email"     placeholder="E-Mail">
    <br>
    <input type="text"      name="uid"       placeholder="Username">
    <br>
    <input type="password"  name="password"  placeholder="Password">
    <br>
    <button type="submit"   name="submit">Create Account</button>
</form>

<?php

?>
</body>
</html>