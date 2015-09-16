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
    $results = $c->multiSearch(array(
        'requests' => array(
            array(
                'collection' => getenv('SAJARI_COLLECTION'),
                'q' => 'hey',
                'meta' => array(
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'created' => 1442293946,
                    'arrayField' => array(
                        'boo',
                        'yah',
                    ),
                ),
                'filters' => array(
                    array(
                        'op' => '=',
                        'key' => 'category',
                        'val' => 'whatever',
                    ),
                    array(
                        'op' => '~',
                        'key' => 'category',
                        'val' => array(
                            'one',
                            'two',
                        ),
                    ),
                ),
            ),
        ),
        'all' => array(
            'company' => getenv('SAJARI_COMPANY'),
        ),
        'merge' => 'linear',
        'timeout' => 2000,
    ));
    echo var_export($results, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error running the search. ', $e->getMessage(), PHP_EOL;
}
