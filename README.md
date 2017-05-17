# Sajari PHP SDK

[![Packagist](https://img.shields.io/packagist/v/sajari/sajari-sdk-php.svg?style=flat-square)](https://packagist.org/packages/sajari/sajari-sdk-php) [![license](http://img.shields.io/badge/license-MIT-green.svg?style=flat-square)](./LICENSE.md)

The Sajari PHP SDK enables use of the Sajari platform from PHP.

We recommend using the [Generated search interface](https://github.com/sajari/sajari-sdk-react/tree/master/examples/basic-site-integration), [Javascript](https://github.com/sajari/sajari-sdk-js) or [React](https://github.com/sajari/sajari-sdk-react) SDKs if you're serving up search results in a web browser:

- Avoids backend integration.
- Minimises latency by sending queries directly to our servers instead of routing via your infrastructure.
- Provides automatic real-time learning using user interactions and other metrics.

## Table of Contents

* [Setup](#setup)
  * [Using with Composer](#using-with-composer)
* [Getting Started](#getting-started)
  * [Creating a Client](#creating-a-client)
  * [Adding a Record](#adding-a-record)
  * [Getting a Record](#getting-a-record)
  * [Deleting a Record](#deleting-a-record)
  * [Mutating a Record](#mutating-a-record)
  * [Retrieving a Schema](#retrieving-a-collection-schema)
  * [Querying](#querying)
    * [Pipelines](#pipelines)
    * [Raw search API](#raw-search-api)
* [License](#license)


## Setup

Requires PHP 5.5+, 7.0+.

1. Get [Composer](https://getcomposer.org/download/).
2. Get the [gRPC](https://pecl.php.net/package/gRPC) extension by running `sudo pecl install grpc`.
3. Add `extension=grpc.so` to your `php.ini` file.
4. Run `php composer.phar install`.

*Note A more complete guide to installing the gRPC extension can be found in the [gRPC PHP README](https://github.com/grpc/grpc/tree/master/src/php).*

### Using with Composer

Add `sajari/sajari-sdk-php` to your `composer.json`:
```
{
  "require": {
    "sajari/sajari-sdk-php": "v1.0.1"
  },
  "minimum-stability": "dev",
  "prefer-stable": true
}
```

## Getting Started

### Creating a Client

To start we need to create a client to make calls to the API:

```php
$client = new Client('your-project', 'your-collection', [
    new WithKeyCredentials('your-key-id', 'your-key-secret')
]);
```

### Adding a record

A record can be added to a collection using the `add` method:

```php
$record = [
    "title" => "The Three Musketeers",
    "slug" => "the-three-musketeers",
    "author" => "Alexandre Dumas",
    "price" => 10.00,
    "qty" => 7,
];
$key = $client->add($record);
```

An exception will be thrown if an error occurred.

If the add is successful, a `$key` (instance of the class `Key`) is returned which uniquely defines the newly inserted record.  This can be used in calls to `get`, `delete` and `mutate` to operate on that record in the collection.  Keys can be defined on any unique field.  Each collection has the unique field `_id` which is set by the system when records are added.  Unique fields can also be created using the API.

#### Adding multiple records

Multiple records can be added in one call.  It's easy to retrieve the keys from each of the add operations (and check that they succeeded).

```php
$records = [
    [
        "title" => "The Three Musketeers",
        "slug" => "the-three-musketeers",
        "author" => "Alexandre Dumas",
        "price" => 10.00,
        "qty" => 7,
    ],
    [
        "title" => "The Remains of the Day",
        "slug" => "the-remains-of-the-day",
        "author" => "Kazuo Ishiguro",
        "price" => 8.00,
        "qty" => 10,
    ],
    [
        "title" => "1984",
        "slug" => "1984",
        "author" => "George Orwell",
        "price" => 15.00,
        "qty" => 0,
    ]
];

$resps = $client->addMulti($records);

foreach($resps as $resp) {
    if ($resp->isError()) {
       echo "error adding record: " . $resp->getStatus() . "\n";
       continue;
    }
    echo $resp->getKey() . "\n";
}
```

### Getting a record

A record can be retrieved from a collection using a `Key`.

```php
$client->get($client->key(""slug", "the-three-musketeers"));
```

An exception will be thrown if an error occurred.

#### Getting multiple records

Multiple records can also be fetched in one call using keys.

```php
$keys = $client->keys("slug", [
    "the-three-musketeers",
    "the-remains-of-the-day",
    "1984",
]);

$resps = $client->getMulti($keys);

foreach($resps as $resp) {
    if ($resp->isError()) {
       echo "error fetching record: " . $resp->getStatus() . "\n";
       continue;
    }
    print_r($resp->getRecord());
}
```

### Deleting a record

A record can be deleted from a collection using a `Key`.

```php
$client->delete($client->key("slug", "1984"));
```

An exception will be thrown if an error occurred.

#### Deleting multiple records

```php
$keys = $client->keys("slug", [
    "the-three-musketeers",
    "the-remains-of-the-day",
    "1984",
]);

$resps = $client->deleteMulti($keys);

foreach($resps as $resp) {
    if ($resp->isError()) {
       echo "error deleting record: " . $resp . "\n";
    }
}
```

### Editing a record

A record can be edited using a `Key` and an associative array of field-value pairs to overwrite existing field values.

```php
$client->edit(
    $client->key("slug", "the-remains-of-the-day"),
    [ "qty" => 10 ]
);
```

#### Editing multiple records

```php
$keys = $client->keys("slug", [
    "the-three-musketeers",
    "the-remains-of-the-day",
    "1984",
]);

$setFields = [
    ["title" => "The Three Musketeers (Original French)"],
    ["qty" => 10],
    ["title" => "George Orwell's 1984"],
];

$resps = $client->editMulti($keys, $setFields);

foreach($resps as $resp) {
    if ($resp->isError()) {
       echo "error editing record: " . $resp . "\n";
    }
}
```

### Retrieving a collection schema

```php
$client->schema()->getFields()
```

### Querying

#### Pipelines

Pipelines are the recommended way to query your collection. They wrap up lots of our more complex functionality into a simple interface.  We offer a few standard pipelines for specific purposes, eg `website` for querying website collections. If you created your collection using the "custom" option in the console, use the `raw` pipeline.

```php
$results = $client->pipeline("books")->search([
    "q" => "musketeers"
]);
```

#### Raw search API

It's also possible to run queries using the raw query API.

```php
$client->Search(new Request("1984"))
```

# License

We use the [MIT License](./LICENSE.md).
