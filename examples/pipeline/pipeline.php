<?php

require  __DIR__ . "/vendor/autoload.php";

include_once "../ExampleUtils.php";

// This script relies on environment variables being set for authentication

// SJ_PROJECT = <Project>
// SJ_COLLECTION = <Collection>
// SJ_KEY_ID = <Key from https://www.sajari.com/console/collections/credentials>
// SJ_KEY_SECRET = <Secret from https://www.sajari.com/console/collections/credentials>

$params = [
    "q" => "foo bar",
    "resultsPerPage" => "10",
];

try  {
    $pipeline = ExampleUtils::CreateClient()->Pipeline("website");
    $results = $pipeline->Search($params);
} catch (\Exception $e) {
    printf("%s\n", $e);
    exit();
}

ExampleUtils::PrintSearchResults($results);
