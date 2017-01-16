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
  * [Adding the SDK to your project](#adding-the-sdk-to-your-project)
  * [Example install on a fresh Ubuntu 16.04](#example-install-on-a-fresh-ubuntu-16.04)
* [Getting Started](#getting-started)
* [Snippets](#snippets)
  * [Performing a text search](#performing-a-text-search)
  * [Getting a record](#getting-a-record)
  * [Deleting a record](#deleting-a-record)
  * [Adding a record](#adding-a-record)
  * [Patching a record](#patching-a-record)
  * [Getting fields from a schema](#getting-fields-from-a-schema)
* [License](#license)

## Setup

### Prerequisites

- Php 5.5+, 7.0+ (requirement from gRPC)
- [Pecl](https://pecl.php.net/)
- [Composer](https://getcomposer.org/) package manager
- [gRPC](https://pecl.php.net/package/gRPC) php extension

### Adding the SDK to your project

Add these sections to your `composer.json` to install the latest version from master.
```
{
  "repositories": [
    {
      "type": "path",
      "url": "https://sajari.github/com/sajari-sdk-php/"
    }
  ],
  "require": {
    "sajari/sajari-sdk-php": "master-dev"
  },
  "minimum-stability": "dev",
  "prefer-stable": true
}
```

### Example install on a fresh Ubuntu 16.04

```bash
sudo apt install php-cli php-dev php-pear
sudo pecl install grpc
```

Add "extension=grpc.so" to php.ini, then add this sdk to your composer.json

## Getting Started

See [examples](./examples) for code you can copy and paste to get started.

## Snippets

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

### Patching a record

```php
$client->Patch(
    new KeyValues(
        new Key("_id", 123), [new KeyValue("name", "bob")]
    )
)
```

Full example: [`./examples/patch.php`](./examples/patch.php)

### Getting fields from a schema

```php
$client->GetFields()
```

## Client

### Creating a Client

```php
$client = Client::NewClient('project', 'collection', [
    WithKeyCredentials('key', 'secret')
]);
```

## License

We use the [MIT License](./LICENSE.md).
