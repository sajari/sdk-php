<?php

// Sets up a basic schema, adds a record, searches for the record

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use \Sajari\Schema\Field;

$client = ExampleUtils::CreateClient();

$fields = [
    new Field("id"  , "id of the user"        , Field::$INTEGER, false, true, false, false, true ),
    new Field("name", "name of the user"      , Field::$STRING , false, true, false, true , false),
    new Field("url" , "url of the user's page", Field::$STRING , false, true, false, false, false)
];

// Set up schema
$addStatuses = $client->AddFields($fields);

foreach ($addStatuses->getStatus() as $k => $s) {
    if ($s->getCode() !== 0) {
        printf("error adding field %s: (%s) %s\n", $fields[$k]->getName(), $s->getCode(), $s->getMessage());
    }
}

// Add record
$client->Add(
    new \Sajari\Record\Record([
        "id" => 1,
        "name" => "Jones",
        "url" => "sajari.com/1"
    ]), []
);

// Search for the record
ExampleUtils::PrintSearchResults(
    $client->Search(new \Sajari\Query\Request("Jones"))
);
