# Sajari PHP SDK

[![Packagist](https://img.shields.io/packagist/v/sajari/sajari-sdk-php.svg?style=flat-square)]() ![license](http://img.shields.io/badge/license-MIT-green.svg?style=flat-square)

The Sajari PHP SDK enables use of the Sajari platform from PHP.

We recommend using the [Javascript](https://github.com/sajari/sajari-sdk-js) or [React](https://github.com/sajari/sajari-sdk-react) SDKs if you're serving up search results in a web browser:

- Avoids backend integration.
- Minimises latency by sending queries directly to our servers instead of routing via your infrastructure.
- Provides automatic real-time learning using user interactions and other metrics.

## Table of Contents

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

## Setup

### Prerequisites

- PHP 5.5+, 7.0+ (required by gRPC)
- [Composer](https://getcomposer.org/)
- [PECL](https://pecl.php.net/)
- [gRPC PHP Extension](https://pecl.php.net/package/gRPC)

### Using with Composer

Add `sajari/sajari-sdk-php` to your `composer.json`:
```
{
  "require": {
    "sajari/sajari-sdk-php": "master-dev"
  },
  "minimum-stability": "dev",
  "prefer-stable": true
}
```

### Basic install of gRPC PHP extension on a fresh install of Ubuntu 16.04

A more complete guide to installing the PHP extention for gRPC can be found in the [gRPC PHP README](https://github.com/grpc/grpc/tree/master/src/php).

```bash
sudo apt install php-cli php-dev php-pear
sudo pecl install grpc
```

Now add `extension=grpc.so` to your `php.ini` file.

## Getting Started

See [examples](./examples) for code you can copy and paste to get started.

## Snippets

### Using the website pipeline

Pipelines are the recommended way to query Sajari. They wrap up lots of our functionality and provide a super simple interface.

```php
$client->SearchPipeline(
  new Request("website", [
    "q" => "Game of Thrones"
  ])
);
```

### Performing a text search

```php
$client->Search(new Request("alex"))
```

Full example: [`./examples/search.php`](./examples/search.php)

### Getting a record

```php
$client->Get(
    new Key("_id", 123)
)
```

Full example: [`./examples/get.php`](./examples/get.php)

### Deleting a record

```php
$client->Delete(
    new Key("_id", 123)
)
```

Full example: [`./examples/delete.php`](./examples/delete.php)

### Adding a record

```php
$client->Add(
    new Record([
        "id" => 123
        "name" => "alex",
        "url" => "site.com/12345"
    ])
)
```

Full example: [`./examples/add.php`](./examples/add.php)

### Mutating a record

```php
$client->Mutate(
    new RecordMutation(
        new Key("_id", 123), [new RecordMutation::SetField("name", "bob")]
    )
)
```

Full example: [`./examples/mutate.php`](./examples/mutate.php)

### Getting fields from a schema

```php
$client->GetFields()
```

Full example: [`./examples/fields.php`](./examples/fields.php)

## Client

### Creating a Client

```php
$client = Client::NewClient('project', 'collection', [
    WithKeyCredentials('key', 'secret')
]);
```

## License

We use the [MIT License](./LICENSE.md).
