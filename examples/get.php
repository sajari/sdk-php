<?php

require  dirname(__FILE__) . '/../src/sajari.php';

use Sajari\WithEndpoint;
use Sajari\Client;
use Sajari\Key;

$opts = [new WithEndpoint('server_address')];

$c = new Client('myproject', 'mycollection', $opts);

$key = new Key("_id", "7f7a8658-a368-d6f9-5e19-791debb6bddb");

try {
    $doc = $c->Get($key);
} catch (Exception $e) {
    echo "Caught exception: ", $e->getMessage();
    exit(1);
}

echo "Retrieved document successfully, got doc meta ", $doc->getMeta(), "\n";