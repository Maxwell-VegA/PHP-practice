<?php
    declare(strict_types = 1);
    include 'includes/autoloader.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            background: #111111;
            color: #eeeeee;
        }
    </style>
</head>
<body>

    <form action="includes/calculator.inc.php" method="POST"> 
        <input type="number" name="num1" value="2"> 
        <input type="number" name="num2" value="6">
        <select name="operator">
            <option value="add">add</option>
            <option value="sub">sub</option>
            <option value="mul">mul</option>
            <option value="div">div</option>
        </select>
        <button type="submit" name="submit">calculate</button>
    
    
    </form>


    <?php
        // $aCertainPerson = new Person("James Von Maxwell", 28);
        // echo $aCertainPerson->name;     // echo $aCertainPerson->age;
        // $aCertainPerson->printName();
        // echo "<br>";
        // echo Person::$drinkingAge;
    ?>
</body>
</html>