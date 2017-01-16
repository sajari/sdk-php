<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use Sajari\Record\KeyValues;
use Sajari\Engine\Key;
use Sajari\Record\KeyValue;

$status = ExampleUtils::CreateClient()->Patch(
    new KeyValues(
        new Key("_id", "<record id>"),
        [new KeyValue("name", "Alex")]
    )
);

ExampleUtils::CheckStatusForErrors($status);