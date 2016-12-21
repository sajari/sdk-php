<?php

require  __DIR__ . "/vendor/autoload.php";

// Get config from environment
$project = getenv("SJ_PROJECT");
$collection = getenv("SJ_COLLECTION");
$key_id = getenv("SJ_KEY_ID");
$key_secret = getenv("SJ_KEY_SECRET");

// Create a client with the default configuration
$client = \Sajari\Client\Client::NewClient(
    $project,
    $collection,
    [new \Sajari\Client\WithAuth($key_id, $key_secret)]
);

// Create request object to perform out query with
$request = new \Sajari\Search\Request();
// Set limit to determine how many results to request
$request->setLimit(1);
// Use default tracking to state that we're not requesting tracking tokens
$request->setTracking(new \Sajari\Search\Tracking());

// Perform a search request
try {
    $result = $client->Search($request);
} catch (\Sajari\Error\MalformedRequestException $e) {
    printf("malformed request: %s\n", $e->getMessage());
    exit(1);
} catch (\Sajari\Error\PermissionDeniedException $e) {
    printf("%s\n", $e->getMessage());
    exit(1);
} catch (\Sajari\Error\ServiceUnavailableException $e) {
    printf("%s\n", $e->getMessage());
    // Retry ?
    exit(1);
} catch (\Sajari\Error\UnauthenticatedException $e) {
    printf("%s\n", $e->getMessage());
    exit(1);
} catch (\Sajari\Error\Exception $e) {
    printf("%s\n", $e->getMessage());
    exit(1);
} catch (\Exception $e) {
    printf("%s\n", $e);
    exit(1);
}

printf("Search found %u results in %s.\n", $result->getTotalResults(), $result->getTime());
foreach ($result->getResults() as $r) {
    printf("Score: %f %f\n", $r->getScore(), $r->getIndexScore());
    foreach ($r->getValues() as $v) {
        if (is_array($v->getValue())) {
            printf("   %s:\n", $v->getKey());
            foreach ($v->getValue() as $i) {
                printf("      %s\n", $i);
            }
        } else {
            printf("   %s: %s\n", $v->getKey(), $v->getValue());
        }
    }
}
