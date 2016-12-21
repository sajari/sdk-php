<?php

$a = [
    "a" => 2,
    "b" => 3,
];

$a = array();
$a[] = 5;
$a[] = 6;

var_dump($a);

foreach ($a as $i => $value) {
    print_r($i);
    print_r($value);
}
