<?php

require  __DIR__ . '/vendor/autoload.php';

include_once "ExampleUtils.php";

$status = ExampleUtils::CreateClient()->Delete(
    new \Sajari\Engine\Key("_id", "<record id>")
);

ExampleUtils::CheckStatusForErrors($status);
