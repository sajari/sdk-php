<?php

require 'vendor/autoload.php';

use Sajari\Engine\EngineClient;
use Sajari\Engine\Exception\EngineException;

$logger = new Monolog\Logger('log');
$logger->pushHandler(new Monolog\Handler\StreamHandler('php://stdout'));

$c = new EngineClient(new Guzzle\Http\Client(), array(
    'access_key' => getenv('SAJARI_ACCESS_KEY'),
    'secret_key' => getenv('SAJARI_SECRET_KEY'),
    'company'    => getenv('SAJARI_COMPANY'),
    'collection' => getenv('SAJARI_COLLECTION'),
), $logger);

try {
    $r = $c->add(array(
        'meta' => array(
            'id' => '123',
            'field'  => 'the field value',
        ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error adding the document. ', $e->getMessage(), PHP_EOL;
}

try {
    $r = $c->get(array(
      'meta' => array(
        'id' => '123',
      ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error getting the document. ', $e->getMessage(), PHP_EOL;
}
