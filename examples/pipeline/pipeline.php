<?php

require  __DIR__ . "/vendor/autoload.php";

include_once "../ExampleUtils.php";

// This script relies on environment variables being set for authentication

// SJ_PROJECT = <Project>
// SJ_COLLECTION = <Collection>
// SJ_KEY_ID = <Key from https://www.sajari.com/app/#/collection/list>
// SJ_KEY_SECRET = <Secret from https://www.sajari.com/app/#/collection/list>

$params = [
    "q" => "foo bar",
    "resultsPerPage" => "10",
];

$tracking = new \Sajari\Query\Tracking();
$tracking->click("url");

try  {
    $pipeline = ExampleUtils::CreateClient()->Pipeline("website");
    $results = $pipeline->Search($params, $tracking);
} catch (\Exception $e) {
    printf("%s\n", $e);
    exit();
}

ExampleUtils::PrintSearchResults($results);
