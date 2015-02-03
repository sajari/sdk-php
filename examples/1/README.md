# Example

This example shows how to add people to a "people" collection and then search
for them.

You should create a "people" collection in Sajari before starting this example.
Note: the name "people" is inconsequential: you could just as well name it
"persons".

## Install

First ensure that you have [Composer](https://getcomposer.org) installed and
then just install the dependencies.

```
php composer.phar install
```

## Setup

Set the following environment variables. Refer to your Sajari engine configuration for these values.

```
SAJARI_ACCESS_KEY=1234
SAJARI_SECRET_KEY=5678
SAJARI_COMPANY=acme
SAJARI_COLLECTION=people
```

## Run

### Add a document

```
FIRST_NAME="Jane" LAST_NAME="Doe" php add.php
```

### Search for documents

```
QUERY="Jane" php search.php
```
