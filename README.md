# Sajari PHP SDK

[![Packagist](https://img.shields.io/packagist/v/sajari/sajari-sdk-php.svg?style=flat-square)]() ![license](http://img.shields.io/badge/license-MIT-green.svg?style=flat-square)

The Sajari PHP SDK enables use of the Sajari platform from PHP.

## Table of Contents

* [Setup](#setup)
  * [Prerequisites](#prerequisites)
  * [PHP 5](#php-5)
  * [Install Sajari](#install-sajari)
* [Getting Started](#getting-started)
* [Documentation](#documentation)
* [License](#license)

## Setup

### Prerequisites

The minimum php versions required for this sdk are php 5.5 and 7.0. This limitation is set by the underlying [gRPC](https://github.com/grpc/grpc/tree/master/src/php) library.

[Pecl](https://pecl.php.net/) is required for installing the `grpc` extension.

[Composer](https://getcomposer.org/) for package management and distribution. Get composer from [here](https://getcomposer.org/download/).

The [gRPC](https://pecl.php.net/package/gRPC) extension is required for this library. It can be installed from Pecl. You can find more information about it [here](https://github.com/grpc/grpc/tree/master/src/php). 

### Adding to your project

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

### Example install on Ubuntu 16.04

```bash
sudo apt install php-cli php-dev php-pear
sudo pecl install grpc
# add "extension=grpc.so" to php.ini
```

## Getting Started

See [examples](./examples) for code you can copy and paste to get started.

- [Performing a search](./examples/search.php)
- [Adding a record](./examples/add.php)
- [Getting a record](./examples/get.php)
- [Patching a record](./examples/patch.php)
- [Deleting a record](./examples/delete.php)

## Snippets

### Performing a text search

```php
$client->Search(
    (new Request())->setIndexQuery(
        (new IndexQuery())->setBody(
            [new Body("foo")]
        )
    )
)
```

### Getting a record

```php
$client->Get(
    new Key("_id", "123")
)
```

### Deleting a record

```php
$client->Delete(
    new Key("_id", "123")
)
```

### Adding a record

```php
$client->Add(
    new Record(["text" => "foo"])
)
```

### Patching a record

```php
$client->Patch(
    new KeyValues(
        new Key("_id", "123), [new KeyValue("text", "foo")]
    )
)
```

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

## Request

### Creating a request

```php
$req = new Request();
```

### Setting a limit

```php
$req->setLimit(10);
```

### Setting an offset

```php
$req->setOffset(5);
```

### Setting an IndexQuery

```php
$req->setIndexQuery($iq);
```

### Setting a FeatureQuery

```php
$req->setFeatureQuery($fq);
```

### Setting a filter

```php
$req->setFilter($f);
```

### Setting sorts

```php
$req->setSorts($sorts);
```

### Setting fields

```php
$req->setFields(["_id", "title", "description");
```

### Setting aggregates

```php
$req->setAggregates($aggs);
```

### Setting tracking

```php
$req->setTracking($tracking);
```

### Setting transforms

```php
$req->setTransforms($transforms);
```

## IndexQuery

### Creating an IndexQuery

```php
$iq = new IndexQuery();
```

### Setting the body

```php
$iq->setBody([$body]);
```

### Setting InstanceBoosts

```php
$iq->setInstanceBoosts([$ib]);
```

### Setting FieldBoosts

```php
$iq->setFieldBoosts([$fb]);
```

## License

We use the [MIT License](./LICENSE.md)