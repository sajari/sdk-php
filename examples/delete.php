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
    [new \Sajari\Client\WithAuth($key_id, $key_secret)]
);

$k = new \Sajari\Record\Key("_id", "<value>");

try {
    $status = $client->Delete($k);
} catch (\Exception $e) {
    printf("%s\n", $e);
    exit(1);
}

if ($status && $status->getCode() != 0) {
    echo $status->getMessage()."\n";
} else {
    echo "Success\n";
}
