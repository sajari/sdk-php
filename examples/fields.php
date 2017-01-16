<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

$res = ExampleUtils::CreateClient()->GetFields();

foreach ($res as $field) {
    printf("%s %s\n", $field->getName(), $field->getType(true));
}
