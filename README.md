# Sajari PHP SDK

[![Packagist](https://img.shields.io/packagist/v/sajari/sajari-sdk-php.svg?style=flat-square)]() ![license](http://img.shields.io/badge/license-MIT-green.svg?style=flat-square)

The Sajari PHP SDK enables use of the Sajari platform from PHP.

## Table of Contents

* [Setup](#setup)
  * [Prerequisites](#prerequisites)
  * [PHP 5](#php-5)
  * [Install Sajari](#install-sajari)
* [Getting Started](#getting-started)
* [License](#license)

## Setup

### Prerequisites

The minimum php versions required for this sdk are php 5.5 and 7.0. This limitation is set by the underlying [gRPC](https://github.com/grpc/grpc/tree/master/src/php) library.

[Pecl](https://pecl.php.net/) is required for installing the `grpc` extension. Pecl can be installed by your system through `brew install pecl

[Composer](https://getcomposer.org/) for package management and distribution. Get composer from [here](https://getcomposer.org/download/).

### PHP-5

Installing on Ubuntu 14.04 LTS

default phpgr
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

### Install Sajari

Add these sections to your `composer.json` to keep up with the latest version.
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

## Getting Started

See [examples](./examples) for the easiest way to get going.

- [Performing a search](./examples/search.php)
- [Adding a record](./examples/add.php)
- [Getting a record](./examples/get.php)
- [Patching a record](./examples/patch.php)
- [Deleting a record](./examples/delete.php)

## License

We use the [MIT License](./LICENSE.md)