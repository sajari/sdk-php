<?php

require 'vendor/autoload.php';

use Sajari\Engine\EngineClient;
use Sajari\Engine\Exception\EngineException;

$c = new EngineClient(new Guzzle\Http\Client(), array(
    'access_key' => getenv('SAJARI_ACCESS_KEY'),
    'secret_key' => getenv('SAJARI_SECRET_KEY'),
    'company'    => getenv('SAJARI_COMPANY'),
    'collection' => getenv('SAJARI_COLLECTION'),
));

try {
    $results = $c->search(array(
        'q'          => getenv('QUERY'),
        'maxresults' => 10,
    ));
    echo var_export($results, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error running the search. ', $e->getMessage(), PHP_EOL;
}
