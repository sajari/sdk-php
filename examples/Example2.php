<?php

// Deletes all records in a collection that match a filter

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use Sajari\Query\Request;
use Sajari\Query\FieldFilter;
use Sajari\Engine\Key;

$client = ExampleUtils::CreateClient();

$searchRequest = (new Request())
    ->setLimit(100)
    ->setFilter(new FieldFilter("title", "~", "neighbour"));

for (;;) {
    $res = $client->Search($searchRequest);
    if (count($res->getResults()) < 1) {
        break;
    }

    $keys = [];
    foreach ($res->getResults() as $r) {
        $keys[] = new Key("_id", $r->getValues()["_id"]);
    }

    printf("Deleting %s keys\n", count($keys));
    $client->DeleteMulti($keys);
}
