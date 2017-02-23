# Using the website pipeline

The website pipeline is the easiest way to get started with Sajari. Once you've created your web collection in the [Console](https://www.sajari.com/app/#/) you can run through the steps in here to query it from PHP.

## Setup

Clone this repo and move into this example directory

```sh
git clone https://github.com/sajari/sajari-sdk-js
cd sajari-sdk-js/examples/pipeline
```

Get [Composer](https://getcomposer.org/download/).

Get the [gRPC](https://pecl.php.net/package/gRPC) extension by running `sudo pecl install grpc`.

Add `extension=grpc.so` to your `php.ini` file.

Run `php composer.phar install`.

Set your details in the environment. Your Key and Secret can be found in the [Console](https://www.sajari.com/app/#/collection/list).

```sh
export SJ_PROJECT="<PROJECT_NAME>"
export SJ_COLLECTION="<COLLECTION_NAME"
export SJ_KEY_ID="<KEY>"
export SJ_KEY_SECRET="<SECRET>"
```



## Running

Run the search with `php pipeline.php`.

Change the value of `q` to change your search query.
