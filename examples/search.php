<?php

require  __DIR__ . "/vendor/autoload.php";

$client = new \Sajari\Client(getenv("SJ_PROJECT"), getenv("SJ_COLLECTION"), [
    new \Sajari\WithKeyCredentials(getenv("SJ_KEY_ID"), getenv("SJ_KEY_SECRET"))
]);

$result = $client->search(new \Sajari\Query\Request("Holiday"));

ExampleUtils::PrintSearchResults($result);
