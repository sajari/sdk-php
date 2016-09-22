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
* [Index Boosts](#index-boosts)
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
