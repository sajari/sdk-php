<?php

require  dirname(__FILE__) . '/../src/sajari.php';

use Sajari\WithEndpoint;
use Sajari\Client;
use Sajari\Request;

$opts = [new WithEndpoint('server_address')];

$c = new Client('myproject', 'mycollection', $opts);

$r = new Request();
$r->setBody("request body of words to search for");
$r->setMaxResults(10);
$r->setPage(1);
$r->setFilter(
    Sajari\All([
        Sajari\EqualTo("type", "webpage"),
        Sajari\EqualTo("category", "education"),
    ])
);
$r->setFields([
    "url", "title", "description", "popularity"
]);
$r->setAggregates([
    Sajari\SumMetricAggregate("float", "float-sum"),
    Sajari\AvgMetricAggregate("float", "float-avg"),
    Sajari\MaxMetricAggregate("float", "float-max"),
    Sajari\MinMetricAggregate("float", "float-min"),

    Sajari\Bucket(
        "more-than-one",
        [Sajari\BucketEntry(
            "more-than-one",
            Sajari\GreaterThan("float", 1.0)
        )]
    ),
    Sajari\Bucket(
        "more-than-one-or-one",
        [Sajari\BucketEntry(
            "more-than-one-or-equal",
            Sajari\GreaterThanOrEqualTo("float", 1.0)
        )]
    ),
    Sajari\Bucket(
        "less-than-fifty",
        [Sajari\BucketEntry(
            "less-than-fifty",
            Sajari\LessThan("float", 50.0)
        )]
    ),
    Sajari\Bucket(
        "equal-to-twenty",
        [Sajari\BucketEntry(
            "equal-to-twenty",
            Sajari\EqualTo("float", 20.0)
        )]
    ),
    Sajari\Count("float", "how-many")
]);
$r->setIndexBoosts([
    // Multiply the weighting of the title by 2
    Sajari\FieldBoost("title", 2)
]);

$sydLat = -33.861662;
$sydLng = 151.210799;

$timeNow = time();
$yearAgo = time() - (365 * 24 * 60 * 60);
$decadeAgo = time() - (10 * 365 * 24 * 60 * 60);

$r->setMetaBoosts([
    // Boost results that are in english
    new Sajari\FilterMetaBoost(
        Sajari\EqualTo("language", "en"), 2
    ),

    // Boost results in Sydney
    Sajari\BoostInsideRegion("lat", "lng", $sydLat, $sydLng, 0.1, 2),

    // Boost more recent results, decreasing with age
    // Results from today get 2x score
    // Results from a year ago get 1x score
    // Results from 10 years ago get 0x score
    new Sajari\IntervalMetaBoost("pageCreated", [
        new Sajari\IntervalMetaBoostPoint($timeNow, 2),
        new Sajari\IntervalMetaBoostPoint($yearAgo, 1),
        new Sajari\IntervalMetaBoostPoint($decadeAgo, 0),
    ]),
]);

try {
    $res = $c->Search($r);
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage();
    exit(1);
}

print_r($res);