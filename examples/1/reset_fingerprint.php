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
    $r = $c->resetFingerprint(array(
      'fingerprint' => 'eJwkjbHOwjAMBl+l8vq3vwIIhq5M7IwsaTEQqG0pdpCiqu+O1W6W9d3dDF/MmoShh8N/gBYMMyn089ICoUW/YIgVtUt8L2q5+vLCD8kUzbnmVkLYn5qzEBVO4/a84vhimeRZ3bjhbxk6jVNcBbtj+PyBJ5AtWcI1uPwCAAD//zxkMDQ=',
      'decoded' => true,
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo 'There was an error resetting the fingerprint. ', $e->getMessage(), PHP_EOL;
}
