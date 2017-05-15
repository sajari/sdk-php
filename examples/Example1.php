<?php

// Sets up a basic schema, adds a record, searches for the record

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use \Sajari\Field;
use \Sajari\Query\Request;

$client = new \Sajari\Client(getenv("SJ_PROJECT"), getenv("SJ_COLLECTION"), [
    new \Sajari\WithKeyCredentials(getenv("SJ_KEY_ID"), getenv("SJ_KEY_SECRET"))
]);

$fields = [
    Field::string("title")->setIndexed(true),
    Field::string("slug"),
    Field::boolean("draft"),
    Field::string("body")->setIndexed(true),
    Field::string("tags")->setRepeated(true),
    Field::timestamp("datecreated"),
    Field::integer("views")
];

// Set up schema
$resp = $client->schema()->addFields($fields);
foreach ($resp as $i => $status) {
    if (!$status->isOK()) {
        printf("error adding field %s: %s\n", $fields[$i]->getName(), $status);
    }
}

// Add records
list($keys, $statuses) = $client->addMulti([
    [
        "title" => "My holiday story",
        "slug" => "my-holiday-story",
        "draft" => "false",
        "body" => "My holiday began with...",
        "tags" => ["holiday", "story"],
        "datecreated" => new DateTime(),
        "views" => 100, // If only it were that easy..
    ],
    [
        "title" => "The new neighbours",
        "slug" => "the-new-neighbours",
        "draft" => "true",
        "body" => "Let me tell you about the new neighbours...",
        "tags" => ["neighbours", "local"],
        "datecreated" => new DateTime(),
        "views" => 0,
    ]
]);
foreach ($statuses as $i => $status) {
    if (!$status->isOK()) {
        printf("error adding record %d: %s", $i, $status);
    }
}

// Search
$results = $client->search(new Request("Holiday"))

// Print the results.
ExampleUtils::PrintSearchResults($results);
