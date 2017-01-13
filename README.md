# Sajari PHP SDK

[![Packagist](https://img.shields.io/packagist/v/sajari/sajari-sdk-php.svg?style=flat-square)]() ![license](http://img.shields.io/badge/license-MIT-green.svg?style=flat-square)

The Sajari PHP SDK enables use of the Sajari platform from PHP.

If you're serving up the results of searches to users in a web browser we recommend using the [js](https://github.com/sajari/sajari-sdk-js) or [react](https://github.com/sajari/sajari-sdk-react) libraries. Benefits include:

- Better user experience for users, queries will use the Sajari server closest to them  
- Faster responses from your service, there's no need to talk to us
- Real time learning based on result popularity and user interactions

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

The minimum php versions required for this sdk are php 5.5 and 7.0. This limitation is set by the underlying [gRPC](https://github.com/grpc/grpc/tree/master/src/php) library.

[Pecl](https://pecl.php.net/) is required for installing the `grpc` extension.

[Composer](https://getcomposer.org/) for package management and distribution. Get composer from [here](https://getcomposer.org/download/).

The [gRPC](https://pecl.php.net/package/gRPC) extension is required for this library. It can be installed from Pecl. You can find more information about it [here](https://github.com/grpc/grpc/tree/master/src/php). 

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
# add "extension=grpc.so" to php.ini
# add to composer
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

## License

We use the [MIT License](./LICENSE.md).
