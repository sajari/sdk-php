<?php

require  __DIR__ . '/vendor/autoload.php';

// This script relies on environment variables being set for authentication

// SJ_PROJECT = <Project>
// SJ_COLLECTION = <Collection>
// SJ_KEY_ID = <Key from https://www.sajari.com/console/collections/credentials>
// SJ_KEY_SECRET = <Secret from https://www.sajari.com/console/collections/credentials>

$client = new \Sajari\Client(getenv("SJ_PROJECT"), getenv("SJ_COLLECTION"), [
    new \Sajari\WithKeyCredentials(getenv("SJ_KEY_ID"), getenv("SJ_KEY_SECRET"))
]);

$key = $client->key("url", "test.com/alex");
$newValue = [ "image" => "alex.jpg" ];

printf("Mutating single record.\n");
try {
    $client->mutate($key, $newValue);
    printf("successfully mutated %s\n", $key);
} catch (\Exception $e) {
    printf("%s\n", $e);
}

$keys = [$key];
$newValues = [$newValue];

printf("Mutating multiple records.\n");
try {
    $statusList = $client->mutateMulti($keys, $newValues);

    for ($i = 0; $i < count($statusList); $i++) {
        if (!$statusList[$i]->isOk()) {
            printf("failed to mutate record %s %s\n", $keys[$i], $statusList[$i]);
            continue;
        }
        printf("successfully mutated %s\n", $keys[$i]);
    }
} catch (\Exception $e) {
    printf("%s\n", $e);
}
