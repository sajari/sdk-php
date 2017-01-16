<?php

require  __DIR__ . "/vendor/autoload.php";

include_once "ExampleUtils.php";

$result = ExampleUtils::CreateClient()->Search(
    new \Sajari\Query\Request("alex", 10)
);

ExampleUtils::PrintSearchResults($result);
