<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

$status = ExampleUtils::CreateClient()->Patch(
    new \Sajari\Record\KeyValues(
        new \Sajari\Engine\Key("_id", "<record id>"),
        [new \Sajari\Record\KeyValue("name", "Alex")]
    )
);

ExampleUtils::CheckStatusForErrors($status);