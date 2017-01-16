<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

/** @var \Sajari\Record\Record $rec */
list($rec, $status) = ExampleUtils::CreateClient()->Get(
    new \Sajari\Engine\Key("_id", "<record id>")
);

ExampleUtils::PrintRecord($rec);
