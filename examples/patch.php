<?php

require  dirname(__FILE__) . '/../src/sajari.php';

use Sajari\WithEndpoint;
use Sajari\Client;
use Sajari\Key;
use Sajari\KeyMeta;
use Sajari\Meta;

$opts = [new WithEndpoint('server_address')];

$c = new Client('myproject', 'mycollection', $opts);

$key = new Key("_id", "7f7a8658-a368-d6f9-5e19-791debb6bddb");

$meta = [new Meta("numericData", 25.2)];

$keyMeta = new KeyMeta($key, $meta);

try {
    $c->Patch($keyMeta);
} catch (Exception $e) {
    echo "Caught exception: ", $e->getMessage();
    exit(1);
}

echo "Patched document successfully\n";