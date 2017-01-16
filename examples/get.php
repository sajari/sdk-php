<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use Sajari\Engine\Key;

/** @var \Sajari\Record\Record $rec */
list($rec, $status) = ExampleUtils::CreateClient()->Get(
    new Key("_id", "<record id>")
);

ExampleUtils::PrintRecord($rec);
