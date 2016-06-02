<?php

require  dirname(__FILE__) . '/../src/sajari.php';

use Sajari\WithEndpoint;
use Sajari\Client;
use Sajari\Document;
use Sajari\Meta;

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