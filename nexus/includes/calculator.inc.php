<?php
    declare(strict_types = 1);
    include 'autoloader.inc.php';

    $operator = $_POST['operator'];
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    $calculate = new Calculator($operator, (int)$num1, (int)$num2);

    try {
        echo $calculate->calculator();
    } catch (TypeError $e) {
        echo "Error!: " . $e-getMessage();
    }