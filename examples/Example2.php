<?php

// Deletes all records in a collection

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

$client = ExampleUtils::CreateClient();

$searchRequest = (new \Sajari\Query\Request())
    ->setLimit(100)
    ->setFields(["_id"]);

for (;;) {
    $res = $client->Search($searchRequest);
    if (count($res->getResults()) < 1) {
        break;
    }

    $keys = [];
    foreach ($res->getResults() as $r) {
        $keys[] = new \Sajari\Engine\Key("_id", $r->getValues()["_id"]);
    }

    printf("Deleting %s keys\n", count($keys));
    $client->DeleteMulti($keys);
}
