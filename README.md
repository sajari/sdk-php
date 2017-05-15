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

See [examples](./examples) for code you can copy and paste to get started.

Also see the [pipeline example](./examples/pipeline) for how to use pipelines with your collection.


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
$key = $client->add([
    "id" => 123
    "name" => "alex",
    "url" => "site.com/12345"
]);
```

An exception will be thrown if an error occurred.

If the add is successful, a `$key` (instance of the class `Key`) is returned which uniquely defines the newly inserted record.  This can be used in calls to `get`, `delete` and `mutate` to operate on that record in the collection.  Keys can be defined on any unique field.  Each collection has the unique field `_id` which is set by the system when records are added.  Unique fields can also be created using the API.

### Getting a record

A record can be retrieved from a collection using a `Key`.

```php
$client->get($client->key("_id", 123));
```

An exception will be thrown if an error occurred.

Full example: [`./examples/get.php`](./examples/get.php)

### Deleting a record

A record can be deleted from a collection using a `Key`.

```php
$client->delete($client->key("_id", 123));
```

An exception will be thrown if an error occurred.

Full example: [`./examples/delete.php`](./examples/delete.php)

### Mutating a record

A record can be mutated using a `Key` and an associative array of field-value pairs to overwrite existing field values.

```php
$client->mutate($client->key("url", "site.com/12345"), [
    "name" => "bob"
]);
```

Full example: [`./examples/mutate.php`](./examples/mutate.php)

### Retrieving a collection schema

```php
$client->schema()->getFields()
```

Full example: [`./examples/fields.php`](./examples/fields.php)

### Querying

#### Pipelines

Pipelines are the recommended way to query your collection. They wrap up lots of our more complex functionality into a simple interface.  We offer a few standard pipelines for specific purposes, eg `website` for querying website collections. If you created your collection using the "custom" option in the console, use the `raw` pipeline.

```php
$results = $client->pipeline("raw")->search([
  "q" => "Game of Thrones" // query text
]);
```

Full example: [`./examples/pipeline/search.php`](./examples/pipeline/search.php)

#### Raw search API

It's also possible to run queries using the raw query API.

```php
$client->Search(new Request("alex"))
```

Full example: [`./examples/search.php`](./examples/search.php)


# License

We use the [MIT License](./LICENSE.md).
