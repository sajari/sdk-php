# Sajari PHP SDK

[![Packagist](https://img.shields.io/packagist/v/sajari/sajari-sdk-php.svg?style=flat-square)](https://packagist.org/packages/sajari/sajari-sdk-php) [![license](http://img.shields.io/badge/license-MIT-green.svg?style=flat-square)](./LICENSE.md)

The Sajari PHP SDK enables use of the Sajari platform from PHP.

We recommend using the [Javascript](https://github.com/sajari/sajari-sdk-js) or [React](https://github.com/sajari/sajari-sdk-react) SDKs if you're serving up search results in a web browser:

- Avoids backend integration.
- Minimises latency by sending queries directly to our servers instead of routing via your infrastructure.
- Provides automatic real-time learning using user interactions and other metrics.

# Table of Contents

* [Setup](#setup)
  * [Prerequisites](#prerequisites)
  * [Using with Composer](#using-with-composer)
  * [Basic install of gRPC PHP extension on a fresh install of Ubuntu 16.04](#basic-install-of-grpc-php-extension-on-a-fresh-install-of-ubuntu-1604)
* [Getting Started](#getting-started)
* [Snippets](#snippets)
  * [Using the website pipeline](#using-the-website-pipeline)
  * [Performing a text search](#performing-a-text-search)
  * [Getting a record](#getting-a-record)
  * [Deleting a record](#deleting-a-record)
  * [Adding a record](#adding-a-record)
  * [Mutating a record](#mutating-a-record)
  * [Getting fields from a schema](#getting-fields-from-a-schema)
* [License](#license)

# Setup

## Prerequisites

- PHP 5.5+, 7.0+ (required by gRPC)
- [Composer](https://getcomposer.org/)
- [PECL](https://pecl.php.net/)
- [gRPC PHP Extension](https://pecl.php.net/package/gRPC)

## Basic install

1. Get [Composer](https://getcomposer.org/download/).
2. Get the [gRPC](https://pecl.php.net/package/gRPC) extension by running `sudo pecl install grpc`.
3. Add `extension=grpc.so` to your `php.ini` file.
4. Run `php composer.phar install`.

*Note A more complete guide to installing the gRPC extension can be found in the [gRPC PHP README](https://github.com/grpc/grpc/tree/master/src/php).*

## Using with Composer

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

# Getting Started

See [examples](./examples) for code you can copy and paste to get started.

Also see the [website pipeline example](./examples/pipeline) for the fastest way to search your website collection.

## Snippets

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

If the add is successful, a `$key` (instance of `Key`) is returned which uniquely defines the newly inserted record.  This can be used later to get the inserted record.

An exception will be thrown if an error occurred.

### Getting a record

A record can be retrieved from a collection using a `Key`.  Keys can be defined on any unique field.  Each collection has the unique field `_id` which is set by the system when records are added.  Unique fields can also be created using the API.

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

Pipelines are the recommended way to query your collection. They wrap up lots of our more complex functionality into a simple interface.  We offer a few standard pipelines for specific purposes, eg "website" for querying website collections.

```php
$results = $client->pipeline("website")->search([
  "q" => "Game of Thrones" // query text
]);
```

#### Raw search API

It's also possible to run queries using the raw query API.

```php
$client->Search(new Request("alex"))
```

Full example: [`./examples/search.php`](./examples/search.php)


# License

We use the [MIT License](./LICENSE.md).
