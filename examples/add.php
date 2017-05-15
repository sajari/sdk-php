<?php

require  __DIR__ . '/vendor/autoload.php';

$client = new \Sajari\Client(getenv("SJ_PROJECT"), getenv("SJ_COLLECTION"), [
    new \Sajari\WithKeyCredentials(getenv("SJ_KEY_ID"), getenv("SJ_KEY_SECRET"))
]);

$key = $client->add([
    "id" => 1,
    "name" => "Jones",
    "url" => "site.com/1"
]);

printf("Record added with key: %s\n", $key);
