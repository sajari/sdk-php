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

// $record = ["title" => "alex", "url" => "test.com/alex"];
//
// printf("Adding single record.\n");
// try  {
//     $client->add($record);
// } catch (\Exception $e) {
//     printf("%s\n", $e);
// }

$keys = [
    $client->key("url", "test.com/alex"),
    $client->key("url", "test.com/robin")
];

printf("Deleting multiple records.\n");
try {
    $statusList = $client->deleteMulti($keys);

    for ($i = 0; $i < count($statusList); $i++) {
        if (!$statusList[$i]->isOk()) {
            printf("failed to delete record %s %s\n", $keys[$i], $statusList[$i]);
            continue;
        }
        printf("successfully deleted %s\n", $keys[$i]);
    }
} catch (\Exception $e) {
    printf("%s\n", $e);
}
