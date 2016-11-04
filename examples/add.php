<?php

require  dirname(__FILE__) . '/vendor/autoload.php';

use Sajari\Client\WithEndpoint;
use Sajari\Client\Client;
use Sajari\Document\Document;
use Sajari\Document\Meta;

$opts = [new WithEndpoint('server_address')];

$c = new Client('myproject', 'mycollection', $opts);

$d = new Document([
    new Meta("_body", "main body of document"),
    new Meta("numericData", 52.3),
    new Meta("docType", "docTypeA"),
]);

try {
    $docKey = $c->Add($d);
} catch (Exception $e) {
    echo "Caught exception: ", $e->getMessage();
    exit(1);
}

echo "Added document successfully, got doc key ", $docKey->getField(), ": ", $docKey->getValue(), "\n";