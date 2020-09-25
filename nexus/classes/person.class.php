<?php

class Person {
    private $name;
    private $age;
    
    public static $drinkingAge = 21;


    public function __construct(string $myNameIs, int $myAgeIs) {
        $this->name = $myNameIs;
        $this->age  = $myAgeIs;
    }

    public function printName() {
        echo $this->name;
    }



}