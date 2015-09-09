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
            'count' => 1,
        ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error adding the document. ', $e->getMessage(), PHP_EOL;
}

try {
    $r = $c->patch(array(
      'meta' => array(
        'id' => '123',
      ),
      'delta' => array(
          'count' => 9,
      ),
      'set' => array(
        'field'  => 'updated the field value',
        'new_field'  => 'new field value',
      ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error patching the document. ', $e->getMessage(), PHP_EOL;
}
