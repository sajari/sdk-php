<?php

require  __DIR__ . '/vendor/autoload.php';

// Get config from environment
$project = getenv("SJ_PROJECT");
$collection = getenv("SJ_COLLECTION");
$key_id = getenv("SJ_KEY_ID");
$key_secret = getenv("SJ_KEY_SECRET");

// Create a client with the default configuration
$client = \Sajari\Client\Client::NewClient(
    $project,
    $collection,
    [new \Sajari\Client\WithKeyCredentials($key_id, $key_secret)]
);

$values = [];
$values["text"] = "some text text";

$d = new \Sajari\Record\Record($values);

try {
    list($key, $status) = $client->Add($d);
} catch (Exception $e) {
    var_dump($e);
    echo 'Caught exception: ', $e->getMessage();
    exit(1);
}

printf("Record added with %s\n", $key->getValue());
