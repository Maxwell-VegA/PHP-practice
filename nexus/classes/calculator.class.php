<?php

class Calculator {
    public $operator;
    public $num1;
    public $num2;

    public function __construct(string $sign, int $numberTwo, int $numberThree) {
        $this->operator = $sign;
        $this->num1     = $numberTwo;
        $this->num2     = $numberThree;
    }

    public function calculator() {
        switch ($this->operator) {
            case "add":
                $result = $this->num1 + $this->num2;
                return $result;
            break;
            case "sub":
                $result = $this->num1 - $this->num2;
                return $result;
            break;
            case "mul":
                $result = $this->num1 * $this->num2;
                return $result;
            break;
            case "div":
                $result = $this->num1 / $this->num2;
                return $result;
            break;
            default:
                echo "calculator error";
        }
    }
}