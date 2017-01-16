<?php

// Sets up a basic schema, adds a record, searches for the record

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use \Sajari\Schema\Field;
use \Sajari\Record\Record;
use \Sajari\Query\Request;

$client = ExampleUtils::CreateClient();

$fields = [
    (new Field("title", Field::$STRING))
        ->setRequired(true)
        ->setIndexed(true),
    (new Field("slug", Field::$STRING))
        ->setRequired(true),
    (new Field("draft", Field::$BOOLEAN)),
    (new Field("body", Field::$STRING))
        ->setRequired(true)
        ->setIndexed(true),
    (new Field("tags", Field::$STRING))
        ->setRepeated(true),
    (new Field("datecreated", Field::$TIMESTAMP))
        ->setRequired(true),
    (new Field("views", Field::$INTEGER))
];

// Set up schema
$addStatuses = $client->AddFields($fields);

foreach ($addStatuses->getStatus() as $k => $s) {
    if ($s->getCode() != 0) {
        printf("error adding field %s: (%s) %s\n", $fields[$k]->getName(), $s->getCode(), $s->getMessage());
    }
}

// Add record
$client->AddMulti(
    [
        new Record([
            "title" => "My holiday story",
            "slug" => "my-holiday-story",
            "draft" => "false",
            "body" => "My holiday began with...",
            "tags" => ["holiday", "story"],
            "datecreated" => new DateTime(),
            "views" => 100, // If only it were that easy..
        ]),
        new Record([
            "title" => "The new neighbours",
            "slug" => "the-new-neighbours",
            "draft" => "true",
            "body" => "Let me tell you about the new neighbours...",
            "tags" => ["neighbours", "local"],
            "datecreated" => new DateTime(),
            "views" => 0,
        ])
    ], []
);

// Search for the record
ExampleUtils::PrintSearchResults(
    $client->Search(new Request("Holiday"))
);
