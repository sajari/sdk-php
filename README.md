# Sajari SDK for PHP

## Quick example

### Search for documents

```php
<?php
require 'vendor/autoload.php';

use Sajari\Engine\EngineClient;
use Sajari\Engine\Exception\EngineException;

// Instantiate an engine client
$c = new EngineClient(new Guzzle\Http\Client(), array(
    'access_key' => '1234',
    'secret_key' => '5678',
    'company'    => 'acme',
    'collection' => 'people',
));

// Search the engine for "widgets budgies" and return a maximum of 10 results.
try {
    $results = $c->search(array(
        'q'          => 'widgets budgies',
        'maxresults' => 10,
    ));
    echo var_export($results, true), PHP_EOL;
} catch (EngineException $e) {
    echo "There was an error running the search.", PHP_EOL;
}

```

### Add a document

```php
<?php
require 'vendor/autoload.php';

use Sajari\Engine\EngineClient;
use Sajari\Engine\Exception\EngineException;

// Instantiate an engine client
$c = new EngineClient(new Guzzle\Http\Client(), array(
    'access_key' => '1234',
    'secret_key' => '5678',
    'company'    => 'acme',
    'collection' => 'people',
));

// Add a document (person) with the given meta.
try {
    $r = $c->add(array(
        'meta' => array(
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
        ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo "There was an error adding the document.", PHP_EOL;
}

```
