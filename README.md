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
    "sajari/sajari-sdk-php": "dev-v10"
  },
  "minimum-stability": "dev",
  "prefer-stable": true
}
```
