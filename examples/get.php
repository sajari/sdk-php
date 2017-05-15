<?php

require  __DIR__ . "/vendor/autoload.php";

// This script relies on environment variables being set for authentication

// SJ_PROJECT = <Project>
// SJ_COLLECTION = <Collection>
// SJ_KEY_ID = <Key from https://www.sajari.com/console/collections/credentials>
// SJ_KEY_SECRET = <Secret from https://www.sajari.com/console/collections/credentials>

$client = new \Sajari\Client(getenv("SJ_PROJECT"), getenv("SJ_COLLECTION"), [
    new \Sajari\WithKeyCredentials(getenv("SJ_KEY_ID"), getenv("SJ_KEY_SECRET"))
]);

$key = $client->key("url", "test.com/alex");

printf("Getting single record.\n");
try {
    $record = $client->get($key);
    print_r($record);
} catch(\Exception $e) {
    printf("%s\n", $e);
}

$keys = [$key, $client->key("url", "test.com/robin")];

printf("\nGetting multiple records.\n");
try {
    list($records, $statusList) = $client->getMulti($keys);

    for ($i = 0; $i < count($records); $i++) {
        if (!$statusList[$i]->isOk()) {
            printf("failed to get record %s %s\n", $keys[$i], $statusList[$i]);
            continue;
        }
        print_r($records[$i]);
    }
} catch (\Exception $e) {
    printf("%s\n", $e);
}
