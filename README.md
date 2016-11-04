# Sajari PHP SDK

The Sajari PHP SDK enables use of the Sajari platform from PHP.

## Table of Contents

* [Setup](#setup)
  * [PHP 5](#php-5)
  * [Composer](#composer)
    * [Get Composer](#get-composer)
    * [Install Sajari](#install-sajari)
* [Getting Started](#getting-started)
* [Body](#body)
* [Page](#page)
* [ResultsPerPage](#resultsperpage)
* [Filter](#filter)
* [Sorting](#sorting)
* [Aggregates](#aggregates)
* [Field Boosts](#field-boosts)
* [Instance Boosts](#instance-boosts)
* [Tracking](#tracking)
* [License](#license)

## PHP-5

Installing on Ubuntu 14.04 LTS

default
```
sudo apt-get install php5 php5-dev php-pear
sudo pecl install grpc
```

php 5.6
```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install --fix-missing php5.6 php5.6-dev php5.6-xml
sudo pecl install grpc
```

Add `extension=grpc.so` to your `php.ini` to enable the grpc extension.

## Composer

### Get Composer

`sajari-sdk-php` uses [Composer](https://getcomposer.org/) for package management and distribution. Get composer from [here](https://getcomposer.org/download/).

## Install Sajari

Add these sections to your `composer.json`
```
{
  "repositories": [
    {
      "type": "path",
      "url": "https://sajari.github/com/sajari-sdk-php/"
    }
  ],
  "require": {
    "sajari/sajari-sdk-php": "v10.x-dev"
  },
  "minimum-stability": "dev",
  "prefer-stable": true
}
```

## Getting Started

Basic example file

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Sajari\Client\WithAuth;
use Sajari\Client\Client;
use Sajari\Search\Request;

$project = "";
$collection = "";

$c = new Client($project, $collection, [new WithAuth('{Key}', '{Secret}')]);

$r = new Request();
$r->setPage(1);
$r->setResultsPerPage(10);

try {
    $res = $c->Search($r);
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage();
    exit(1);
}

printf("Search found %u results in %s.\n", $res->getTotalResults(), $res->getTime());

foreach ($res->getResults() as $r) {
  printf("Score: %f %f\n", $r->getScore(), $r->getRawScore());
  foreach ($r->getMeta() as $m) {
    printf("   Meta: %s: %s\n", $m->getKey(), $m->getValue());
  }
}
```

## Body

```php
use Sajari\Search\Body;

$request->setBody([new Body("my search query", 1)]);
```

## Page

```php
$request->setPage(2);
```

## ResultsPerPage

```php
$request->setResultsPerPage(10);
```

## Filter

Filters let you exclude documents from the result set. A query only has 1 filter attached to it, but it is still possible to construct arbitrarily nested filters to satisfy any query logic.

```php
$request->setFilter($filter);
```

### FieldFilter

Field filters act on a value in a field, resulting in a true or false result.

| Query Filter |
| :-- |
| `EQUAL_TO` |
| `DOES_NOT_EQUAL` |
| `GREATER_THAN` |
| `GREATER_THAN_OR_EQUAL_TO` |
| `LESS_THAN` |
| `LESS_THAN_OR_EQUAL_TO` |
| `CONTAINS` |
| `DOES_NOT_CONTAIN` |
| `ENDS_WITH` |
| `STARTS_WITH` |

```php
$filter = new FieldFilter(FieldFilter::LESS_THAN, "price", 100);
```

### CombinatorFilter

Combinator filters act on an array of filters, also resulting in a true of false result.

| Query Filter Combinator |
| :-- |
| `ALL` |
| `ANY` |
| `ONE` |
| `NONE` |

```php
$filter = new CombinatorFilter(CombinatorFilter::ALL, [
  // Array of filters
]);
```

## Sorting

## Aggregates

## Field Boosts

Field boosts allow you to influence the scoring of results based on the data in certain meta fields. In theory they are similar to filters that influence the score rather than exclude/include documents.

### FilterFieldBoost

`FilterFieldBoost` applies the boost to a document if it satisfies a given filter.

| Parameter | Type | Required | Default | Description |
| :-- | :-: | :-: | :-:  | :-- |
| filter | [`Filter`](#filter) | Yes | | The filter to determine whether to boost or not |
| value | float | Yes | | The value to boost by |

```php
new FilterFieldBoost($filter, 1.5)
```

### AdditiveFieldBoost

`AdditiveFieldBoost` transforms a boost into an Additive boost.

| Parameter | Type | Required | Default | Description |
| :-- | :-: | :-: | :-:  | :-- |
| boost | [`Field Boost`](#field-boosts) | Yes | | The Boost to transform |
| value | float | Yes | | The percentage of the query to attribute to this boost |

```php
new AdditiveFieldBoost($boost, 0.1) // 10%
```

### GeoFieldBoost

`GeoFieldBoost` boosts results based on latitude longitude values.

| Parameter | Type | Required | Default | Description |
| :-- | :-: | :-: | :-:  | :-- |
| fieldLat | string | Yes | | The field containing latitude |
| fieldLng | string | Yes | | The field containing longitude |
| lat | float | Yes | | The latitude to compare against |
| lng | float | Yes | | The longitude to compare against |
| radius | float | Yes | | The radius to limit the boost area (km) |
| region | `Region` | Yes | | The region to apply the boost to |

| Region |
| :-- |
| `INSIDE` |
| `OUTSIDE` |

```php
new GeoFieldBoost("lat", "lng", -33.8688, 151.2093, 50, 1.5, GeoFieldBoost::INSIDE)
```

### IntervalFieldBoost

`IntervalFieldBoost` boosts results based on where they fall within a series of values at arbitrary intervals.

| Parameter | Type | Required | Default | Description |
| :-- | :-: | :-: | :-:  | :-- |
| field | string | Yes | | The field to use as the basis for the boost |
| points | point array | Yes | | The points to use |

`IntervalFieldBoostPoint` is for declaring the points on the series and the boost value that should be attributed at that point.

| Parameter | Type | Required | Default | Description |
| :-- | :-: | :-: | :-:  | :-- |
| point | float | Yes | | The point to boost at the the value |
| value | float | Yes | | The value to boost by |

```php
new IntervalFieldBoost("rating", [
  new IntervalFieldBoostPoint(5, 1.0),
  new IntervalFieldBoostPoint(4, 0.9),
  new IntervalFieldBoostPoint(3, 0.6),
  new IntervalFieldBoostPoint(2, 0.2),
  new IntervalFieldBoostPoint(1, 0.1),
])
```

## Instance Boosts

## Tracking

### PosNeg

```php
use Sajari\Search\Tracking;

$tracking = new Tracking();
$tracking->posNeg("_id");

// ...

$result = $client->Search($request, $tracking);

$tokens = $result->getTokens();
```
