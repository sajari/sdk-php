<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

use Sajari\Engine\Key;

$status = ExampleUtils::CreateClient()->Delete(
    new Key("_id", "<record id>")
);

ExampleUtils::CheckStatusForErrors($status);
