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
    $r = $c->put(array(
        'id' => getenv('DOCUMENT_ID'),
        'q' => implode(' ', array(getenv('FIRST_NAME'), getenv('LAST_NAME'))),
        'meta' => array(
            'first_name' => getenv('FIRST_NAME'),
            'last_name'  => getenv('LAST_NAME'),
        ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo "There was an error putting the document.", $e->getMessage(), PHP_EOL;
}
