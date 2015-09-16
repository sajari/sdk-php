<?php

require 'vendor/autoload.php';

use Sajari\Engine\EngineClient;
use Sajari\Engine\Exception\EngineException;

$logger = new Monolog\Logger('log');
$logger->pushHandler(new Monolog\Handler\StreamHandler('php://stdout'));

$c = new EngineClient(new Guzzle\Http\Client(), array(
    'access_key' => getenv('SAJARI_ACCESS_KEY'),
    'secret_key' => getenv('SAJARI_SECRET_KEY'),
    'company' => getenv('SAJARI_COMPANY'),
    'collection' => getenv('SAJARI_COLLECTION'),
), $logger);

try {
    $results = $c->search(array(
        'q' => '',
        'filters' => array(
            array(
                'op' => '=',
                'key' => 'first_name',
                'val' => 'peter',
            ),
            array(
                'op' => '~',
                'key' => 'some',
                'val' => 'here',
            ),
        ),
    ));
    echo var_export($results, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error running the search. ', $e->getMessage(), PHP_EOL;
}
