<?php

require  __DIR__ . "/vendor/autoload.php";

include_once "ExampleUtils.php";

use Sajari\Query\Request;

$result = ExampleUtils::CreateClient()->Search(
    new Request("Holiday")
);

ExampleUtils::PrintSearchResults($result);
