<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use Sajari\Record\Record;

/** @var \Sajari\Engine\Key $key */
list($key, $status) = ExampleUtils::CreateClient()->Add(
    new Record([
        "id" => 1,
        "name" => "Jones",
        "url" => "site.com/1"
    ]), []
);

printf("Record added with %s %s\n", $key->getField(), $key->getValue());
