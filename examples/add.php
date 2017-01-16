<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

/** @var \Sajari\Engine\Key $key */
list($key, $status) = ExampleUtils::CreateClient()->Add(
    new \Sajari\Record\Record([
        "id" => 1,
        "name" => "Jones",
        "url" => "site.com/1"
    ]), []
);

printf("Record added with %s %s\n", $key->getField(), $key->getValue());
