# Sajari SDK for PHP

[![Build status](https://travis-ci.org/sajari/sdk-php.svg?branch=master)](https://travis-ci.org/sajari/sdk-php)

The official [Sajari](https://www.sajari.com) PHP client library.

Sajari is a smart, highly-configurable, real-time search service that enables thousands of businesses worldwide to provide amazing search experiences on their websites, stores, and applications.

## Table of contents

- [Installation & usage](#installation--usage)
  - [Requirements](#requirements)
  - [Composer](#composer)
  - [Manual installation](#manual-installation)
- [Getting started](#getting-started)
- [API endpoints](#api-endpoints)
- [Models](#models)
- [Authorization](#authorization)
  - [BasicAuth](#basicauth)
- [Tests](#tests)
- [Author](#author)
- [About this package](#about-this-package)

## Installation & usage

### Requirements

PHP 7.2 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/sajari/sdk-php.git"
    }
  ],
  "require": {
    "sajari/sdk-php": "*@dev"
  }
}
```

Then run `composer install`

### Manual installation

Download the files and include `autoload.php`:

```php
<?php
require_once "/path/to/OpenAPIClient-php/vendor/autoload.php";
```

## Getting started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\CollectionsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The ID to use for the collection.  This must start with an alphanumeric character followed by one or more alphanumeric or `-` characters. Strictly speaking, it must match the regular expression: `^[A-Za-z][A-Za-z0-9\\-]*$`.
$collection = new \Sajari\Model\Collection(); // \Sajari\Model\Collection | Details of the collection to create.

try {
  $result = $apiInstance->createCollection($collection_id, $collection);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->createCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

## API endpoints

All URIs are relative to *https://api-gateway.sajari.com*

| Class          | Method                                                                       | HTTP request                                                                       | Description                  |
| -------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------- |
| CollectionsApi | [**createCollection**](docs/Api/CollectionsApi.md#createcollection)          | **POST** /v4/collections                                                           | Create collection            |
| CollectionsApi | [**deleteCollection**](docs/Api/CollectionsApi.md#deletecollection)          | **DELETE** /v4/collections/{collection_id}                                         | Delete collection            |
| CollectionsApi | [**getCollection**](docs/Api/CollectionsApi.md#getcollection)                | **GET** /v4/collections/{collection_id}                                            | Get collection               |
| CollectionsApi | [**listCollections**](docs/Api/CollectionsApi.md#listcollections)            | **GET** /v4/collections                                                            | List collections             |
| CollectionsApi | [**queryCollection**](docs/Api/CollectionsApi.md#querycollection)            | **POST** /v4/collections/{collection_id}:queryCollection                           | Query collection             |
| CollectionsApi | [**updateCollection**](docs/Api/CollectionsApi.md#updatecollection)          | **PATCH** /v4/collections/{collection_id}                                          | Update collection            |
| PipelinesApi   | [**createPipeline**](docs/Api/PipelinesApi.md#createpipeline)                | **POST** /v4/collections/{collection_id}/pipelines                                 | Create pipeline              |
| PipelinesApi   | [**generatePipelines**](docs/Api/PipelinesApi.md#generatepipelines)          | **POST** /v4/collections/{collection_id}:generatePipelines                         | Generate pipelines           |
| PipelinesApi   | [**getDefaultPipeline**](docs/Api/PipelinesApi.md#getdefaultpipeline)        | **GET** /v4/collections/{collection_id}:getDefaultPipeline                         | Get default pipeline         |
| PipelinesApi   | [**getDefaultVersion**](docs/Api/PipelinesApi.md#getdefaultversion)          | **GET** /v4/collections/{collection_id}/pipelines/{type}/{name}:getDefaultVersion  | Get default pipeline version |
| PipelinesApi   | [**getPipeline**](docs/Api/PipelinesApi.md#getpipeline)                      | **GET** /v4/collections/{collection_id}/pipelines/{type}/{name}/{version}          | Get pipeline                 |
| PipelinesApi   | [**listPipelines**](docs/Api/PipelinesApi.md#listpipelines)                  | **GET** /v4/collections/{collection_id}/pipelines                                  | List pipelines               |
| PipelinesApi   | [**setDefaultPipeline**](docs/Api/PipelinesApi.md#setdefaultpipeline)        | **POST** /v4/collections/{collection_id}:setDefaultPipeline                        | Set default pipeline         |
| PipelinesApi   | [**setDefaultVersion**](docs/Api/PipelinesApi.md#setdefaultversion)          | **POST** /v4/collections/{collection_id}/pipelines/{type}/{name}:setDefaultVersion | Set default pipeline version |
| RecordsApi     | [**batchUpsertRecords**](docs/Api/RecordsApi.md#batchupsertrecords)          | **POST** /v4/collections/{collection_id}/records:batchUpsert                       | Batch upsert records         |
| RecordsApi     | [**deleteRecord**](docs/Api/RecordsApi.md#deleterecord)                      | **POST** /v4/collections/{collection_id}/records:delete                            | Delete record                |
| RecordsApi     | [**getRecord**](docs/Api/RecordsApi.md#getrecord)                            | **POST** /v4/collections/{collection_id}/records:get                               | Get record                   |
| RecordsApi     | [**upsertRecord**](docs/Api/RecordsApi.md#upsertrecord)                      | **POST** /v4/collections/{collection_id}/records:upsert                            | Upsert record                |
| SchemaApi      | [**batchCreateSchemaFields**](docs/Api/SchemaApi.md#batchcreateschemafields) | **POST** /v4/collections/{collection_id}/schemaFields:batchCreate                  | Batch create schema fields   |
| SchemaApi      | [**createSchemaField**](docs/Api/SchemaApi.md#createschemafield)             | **POST** /v4/collections/{collection_id}/schemaFields                              | Create schema field          |
| SchemaApi      | [**listSchemaFields**](docs/Api/SchemaApi.md#listschemafields)               | **GET** /v4/collections/{collection_id}/schemaFields                               | List schema fields           |

## Models

- [BatchCreateSchemaFieldsRequest](docs/Model/BatchCreateSchemaFieldsRequest.md)
- [BatchCreateSchemaFieldsResponse](docs/Model/BatchCreateSchemaFieldsResponse.md)
- [BatchCreateSchemaFieldsResponseError](docs/Model/BatchCreateSchemaFieldsResponseError.md)
- [BatchUpsertRecordsRequest](docs/Model/BatchUpsertRecordsRequest.md)
- [BatchUpsertRecordsRequestPipeline](docs/Model/BatchUpsertRecordsRequestPipeline.md)
- [BatchUpsertRecordsResponse](docs/Model/BatchUpsertRecordsResponse.md)
- [BatchUpsertRecordsResponseError](docs/Model/BatchUpsertRecordsResponseError.md)
- [BatchUpsertRecordsResponseKey](docs/Model/BatchUpsertRecordsResponseKey.md)
- [BatchUpsertRecordsResponseVariables](docs/Model/BatchUpsertRecordsResponseVariables.md)
- [Collection](docs/Model/Collection.md)
- [DeleteRecordRequest](docs/Model/DeleteRecordRequest.md)
- [Error](docs/Model/Error.md)
- [GeneratePipelinesRequest](docs/Model/GeneratePipelinesRequest.md)
- [GeneratePipelinesResponse](docs/Model/GeneratePipelinesResponse.md)
- [GetDefaultPipelineResponse](docs/Model/GetDefaultPipelineResponse.md)
- [GetDefaultVersionRequestView](docs/Model/GetDefaultVersionRequestView.md)
- [GetPipelineRequestView](docs/Model/GetPipelineRequestView.md)
- [GetRecordRequest](docs/Model/GetRecordRequest.md)
- [ListCollectionsResponse](docs/Model/ListCollectionsResponse.md)
- [ListPipelinesRequestView](docs/Model/ListPipelinesRequestView.md)
- [ListPipelinesResponse](docs/Model/ListPipelinesResponse.md)
- [ListSchemaFieldsResponse](docs/Model/ListSchemaFieldsResponse.md)
- [Pipeline](docs/Model/Pipeline.md)
- [PipelineStep](docs/Model/PipelineStep.md)
- [PipelineStepParamBinding](docs/Model/PipelineStepParamBinding.md)
- [PipelineType](docs/Model/PipelineType.md)
- [ProtobufAny](docs/Model/ProtobufAny.md)
- [ProtobufNullValue](docs/Model/ProtobufNullValue.md)
- [QueryAggregateResult](docs/Model/QueryAggregateResult.md)
- [QueryAggregateResultAnalysis](docs/Model/QueryAggregateResultAnalysis.md)
- [QueryAggregateResultBuckets](docs/Model/QueryAggregateResultBuckets.md)
- [QueryAggregateResultBucketsBucket](docs/Model/QueryAggregateResultBucketsBucket.md)
- [QueryAggregateResultCount](docs/Model/QueryAggregateResultCount.md)
- [QueryAggregateResultDate](docs/Model/QueryAggregateResultDate.md)
- [QueryAggregateResultMetric](docs/Model/QueryAggregateResultMetric.md)
- [QueryCollectionRequest](docs/Model/QueryCollectionRequest.md)
- [QueryCollectionRequestPipeline](docs/Model/QueryCollectionRequestPipeline.md)
- [QueryCollectionRequestTracking](docs/Model/QueryCollectionRequestTracking.md)
- [QueryCollectionRequestTrackingType](docs/Model/QueryCollectionRequestTrackingType.md)
- [QueryCollectionResponse](docs/Model/QueryCollectionResponse.md)
- [QueryCollectionResponsePipeline](docs/Model/QueryCollectionResponsePipeline.md)
- [QueryResult](docs/Model/QueryResult.md)
- [QueryResultToken](docs/Model/QueryResultToken.md)
- [QueryResultTokenClick](docs/Model/QueryResultTokenClick.md)
- [QueryResultTokenPosNeg](docs/Model/QueryResultTokenPosNeg.md)
- [RecordKey](docs/Model/RecordKey.md)
- [SchemaField](docs/Model/SchemaField.md)
- [SchemaFieldMode](docs/Model/SchemaFieldMode.md)
- [SchemaFieldType](docs/Model/SchemaFieldType.md)
- [SetDefaultPipelineRequest](docs/Model/SetDefaultPipelineRequest.md)
- [SetDefaultVersionRequest](docs/Model/SetDefaultVersionRequest.md)
- [Status](docs/Model/Status.md)
- [UpsertRecordRequest](docs/Model/UpsertRecordRequest.md)
- [UpsertRecordRequestPipeline](docs/Model/UpsertRecordRequestPipeline.md)
- [UpsertRecordResponse](docs/Model/UpsertRecordResponse.md)

## Authorization

### BasicAuth

- **Type**: HTTP basic authentication

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

support@sajari.com

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v4`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
