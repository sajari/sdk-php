<?php

require  __DIR__ . '/vendor/autoload.php';

$client = new \Sajari\Client(getenv("SJ_PROJECT"), getenv("SJ_COLLECTION"), [
    new \Sajari\WithKeyCredentials(getenv("SJ_KEY_ID"), getenv("SJ_KEY_SECRET"))
]);

$fields = $client->schema()->fetFields();

foreach ($fields as $field) {
    printf("%s (%s\n)", $field->get);
}
