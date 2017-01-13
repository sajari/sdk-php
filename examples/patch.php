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

$k = new \Sajari\Engine\Key("_id", "<value>");

$m = new \Sajari\Record\KeyValue("text", "i got patched!");

$km = new \Sajari\Record\KeyValues($k, [$m]);

try {
    $status = $client->Patch($km);
} catch (\Exception $e) {
    printf("%s\n", $e);
    exit(1);
}

if ($status && $status->getCode() != 0) {
    echo $status->getMessage()."\n";
} else {
    echo "Success\n";
}
