<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use Sajari\Record\RecordMutation;
use Sajari\Key\Key;

$status = ExampleUtils::CreateClient()->Mutate(
    new RecordMutation(
        new Key("_id", "<record id>"),
        [RecordMutation::SetField("name", "Alex")]
    )
);

ExampleUtils::CheckStatusForErrors($status);
