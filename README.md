# Search.io SDK for PHP

[![Build status](https://github.com/sajari/sdk-php/workflows/Build/badge.svg?branch=master)](https://github.com/sajari/sdk-php/actions)

The official [Search.io](https://www.sajari.com) PHP client library.

Search.io offers a search and discovery service with Neuralsearch®, the world's first instant AI search technology. Businesses of all sizes use Search.io to build site search and discovery solutions that maximize e-commerce revenue, optimize on-site customer experience, and scale their online presence.

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

All URIs are relative to *https://api.search.io*

| Class          | Method                                                                       | HTTP request                                                                       | Description                  |
| -------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------- |
| CollectionsApi | [**createCollection**](docs/Api/CollectionsApi.md#createcollection)          | **POST** /v4/collections                                                           | Create collection            |
| CollectionsApi | [**deleteCollection**](docs/Api/CollectionsApi.md#deletecollection)          | **DELETE** /v4/collections/{collection_id}                                         | Delete collection            |
| CollectionsApi | [**experiment**](docs/Api/CollectionsApi.md#experiment)                      | **POST** /v4/collections/{collection_id}:experiment                                | Experiment                   |
| CollectionsApi | [**getCollection**](docs/Api/CollectionsApi.md#getcollection)                | **GET** /v4/collections/{collection_id}                                            | Get collection               |
| CollectionsApi | [**listCollections**](docs/Api/CollectionsApi.md#listcollections)            | **GET** /v4/collections                                                            | List collections             |
| CollectionsApi | [**queryCollection**](docs/Api/CollectionsApi.md#querycollection)            | **POST** /v4/collections/{collection_id}:query                                     | Query collection             |
| CollectionsApi | [**queryCollection2**](docs/Api/CollectionsApi.md#querycollection2)          | **POST** /v4/collections/{collection_id}:queryCollection                           | Query collection             |
| CollectionsApi | [**trackEvent**](docs/Api/CollectionsApi.md#trackevent)                      | **POST** /v4/collections/{collection_id}:trackEvent                                | Track event                  |
| CollectionsApi | [**updateCollection**](docs/Api/CollectionsApi.md#updatecollection)          | **PATCH** /v4/collections/{collection_id}                                          | Update collection            |
| EventsApi      | [**sendEvent**](docs/Api/EventsApi.md#sendevent)                             | **POST** /v4/events:send                                                           | Send event                   |
| EventsApi      | [**sendEvent2**](docs/Api/EventsApi.md#sendevent2)                           | **POST** /v4/events:sendEvent                                                      | Send event                   |
| PipelinesApi   | [**createPipeline**](docs/Api/PipelinesApi.md#createpipeline)                | **POST** /v4/collections/{collection_id}/pipelines                                 | Create pipeline              |
| PipelinesApi   | [**generatePipelines**](docs/Api/PipelinesApi.md#generatepipelines)          | **POST** /v4/collections/{collection_id}:generatePipelines                         | Generate pipelines           |
| PipelinesApi   | [**getDefaultPipeline**](docs/Api/PipelinesApi.md#getdefaultpipeline)        | **GET** /v4/collections/{collection_id}:getDefaultPipeline                         | Get default pipeline         |
| PipelinesApi   | [**getDefaultVersion**](docs/Api/PipelinesApi.md#getdefaultversion)          | **GET** /v4/collections/{collection_id}/pipelines/{type}/{name}:getDefaultVersion  | Get default pipeline version |
| PipelinesApi   | [**getPipeline**](docs/Api/PipelinesApi.md#getpipeline)                      | **GET** /v4/collections/{collection_id}/pipelines/{type}/{name}/{version}          | Get pipeline                 |
| PipelinesApi   | [**listPipelines**](docs/Api/PipelinesApi.md#listpipelines)                  | **GET** /v4/collections/{collection_id}/pipelines                                  | List pipelines               |
| PipelinesApi   | [**setDefaultPipeline**](docs/Api/PipelinesApi.md#setdefaultpipeline)        | **POST** /v4/collections/{collection_id}:setDefaultPipeline                        | Set default pipeline         |
| PipelinesApi   | [**setDefaultVersion**](docs/Api/PipelinesApi.md#setdefaultversion)          | **POST** /v4/collections/{collection_id}/pipelines/{type}/{name}:setDefaultVersion | Set default pipeline version |
| PromotionsApi  | [**createPromotion**](docs/Api/PromotionsApi.md#createpromotion)             | **POST** /v4/collections/{collection_id}/promotions                                | Create promotion             |
| PromotionsApi  | [**deletePromotion**](docs/Api/PromotionsApi.md#deletepromotion)             | **DELETE** /v4/collections/{collection_id}/promotions/{promotion_id}               | Delete promotion             |
| PromotionsApi  | [**getPromotion**](docs/Api/PromotionsApi.md#getpromotion)                   | **GET** /v4/collections/{collection_id}/promotions/{promotion_id}                  | Get promotion                |
| PromotionsApi  | [**listPromotions**](docs/Api/PromotionsApi.md#listpromotions)               | **GET** /v4/collections/{collection_id}/promotions                                 | List promotions              |
| PromotionsApi  | [**updatePromotion**](docs/Api/PromotionsApi.md#updatepromotion)             | **PATCH** /v4/collections/{collection_id}/promotions/{promotion_id}                | Update promotion             |
| RecordsApi     | [**batchUpdateRecords**](docs/Api/RecordsApi.md#batchupdaterecords)          | **POST** /v4/collections/{collection_id}/records:batchUpdate                       | Batch update records         |
| RecordsApi     | [**batchUpsertRecords**](docs/Api/RecordsApi.md#batchupsertrecords)          | **POST** /v4/collections/{collection_id}/records:batchUpsert                       | Batch upsert records         |
| RecordsApi     | [**deleteRecord**](docs/Api/RecordsApi.md#deleterecord)                      | **POST** /v4/collections/{collection_id}/records:delete                            | Delete record                |
| RecordsApi     | [**getRecord**](docs/Api/RecordsApi.md#getrecord)                            | **POST** /v4/collections/{collection_id}/records:get                               | Get record                   |
| RecordsApi     | [**updateRecord**](docs/Api/RecordsApi.md#updaterecord)                      | **POST** /v4/collections/{collection_id}/records:update                            | Update record                |
| RecordsApi     | [**upsertRecord**](docs/Api/RecordsApi.md#upsertrecord)                      | **POST** /v4/collections/{collection_id}/records:upsert                            | Upsert record                |
| RedirectsApi   | [**createRedirect**](docs/Api/RedirectsApi.md#createredirect)                | **POST** /v4/collections/{collection_id}/redirects                                 | Create redirect              |
| RedirectsApi   | [**deleteRedirect**](docs/Api/RedirectsApi.md#deleteredirect)                | **DELETE** /v4/collections/{collection_id}/redirects/{redirect_id}                 | Delete redirect              |
| RedirectsApi   | [**getRedirect**](docs/Api/RedirectsApi.md#getredirect)                      | **GET** /v4/collections/{collection_id}/redirects/{redirect_id}                    | Get redirect                 |
| RedirectsApi   | [**listRedirects**](docs/Api/RedirectsApi.md#listredirects)                  | **GET** /v4/collections/{collection_id}/redirects                                  | List redirects               |
| RedirectsApi   | [**updateRedirect**](docs/Api/RedirectsApi.md#updateredirect)                | **PATCH** /v4/collections/{collection_id}/redirects/{redirect_id}                  | Update redirect              |
| SchemaApi      | [**batchCreateSchemaFields**](docs/Api/SchemaApi.md#batchcreateschemafields) | **POST** /v4/collections/{collection_id}/schemaFields:batchCreate                  | Batch create schema fields   |
| SchemaApi      | [**createSchemaField**](docs/Api/SchemaApi.md#createschemafield)             | **POST** /v4/collections/{collection_id}/schemaFields                              | Create schema field          |
| SchemaApi      | [**listSchemaFields**](docs/Api/SchemaApi.md#listschemafields)               | **GET** /v4/collections/{collection_id}/schemaFields                               | List schema fields           |

## Models

- [ActivePromotion](docs/Model/ActivePromotion.md)
- [Banner](docs/Model/Banner.md)
- [BatchCreateSchemaFieldsRequest](docs/Model/BatchCreateSchemaFieldsRequest.md)
- [BatchCreateSchemaFieldsResponse](docs/Model/BatchCreateSchemaFieldsResponse.md)
- [BatchCreateSchemaFieldsResponseError](docs/Model/BatchCreateSchemaFieldsResponseError.md)
- [BatchUpdateRecordsRequest](docs/Model/BatchUpdateRecordsRequest.md)
- [BatchUpdateRecordsResponse](docs/Model/BatchUpdateRecordsResponse.md)
- [BatchUpdateRecordsResponseError](docs/Model/BatchUpdateRecordsResponseError.md)
- [BatchUpdateRecordsResponseRecord](docs/Model/BatchUpdateRecordsResponseRecord.md)
- [BatchUpsertRecordsRequest](docs/Model/BatchUpsertRecordsRequest.md)
- [BatchUpsertRecordsRequestPipeline](docs/Model/BatchUpsertRecordsRequestPipeline.md)
- [BatchUpsertRecordsResponse](docs/Model/BatchUpsertRecordsResponse.md)
- [BatchUpsertRecordsResponseError](docs/Model/BatchUpsertRecordsResponseError.md)
- [BatchUpsertRecordsResponseKey](docs/Model/BatchUpsertRecordsResponseKey.md)
- [BatchUpsertRecordsResponseVariables](docs/Model/BatchUpsertRecordsResponseVariables.md)
- [Collection](docs/Model/Collection.md)
- [DeleteRecordRequest](docs/Model/DeleteRecordRequest.md)
- [Error](docs/Model/Error.md)
- [Event](docs/Model/Event.md)
- [ExperimentRequest](docs/Model/ExperimentRequest.md)
- [ExperimentRequestPipeline](docs/Model/ExperimentRequestPipeline.md)
- [ExperimentResponse](docs/Model/ExperimentResponse.md)
- [GeneratePipelinesRequest](docs/Model/GeneratePipelinesRequest.md)
- [GeneratePipelinesResponse](docs/Model/GeneratePipelinesResponse.md)
- [GetDefaultPipelineResponse](docs/Model/GetDefaultPipelineResponse.md)
- [GetDefaultVersionRequestView](docs/Model/GetDefaultVersionRequestView.md)
- [GetPipelineRequestView](docs/Model/GetPipelineRequestView.md)
- [GetRecordRequest](docs/Model/GetRecordRequest.md)
- [ListCollectionsResponse](docs/Model/ListCollectionsResponse.md)
- [ListPipelinesRequestView](docs/Model/ListPipelinesRequestView.md)
- [ListPipelinesResponse](docs/Model/ListPipelinesResponse.md)
- [ListPromotionsRequestPromotionView](docs/Model/ListPromotionsRequestPromotionView.md)
- [ListPromotionsResponse](docs/Model/ListPromotionsResponse.md)
- [ListRedirectsResponse](docs/Model/ListRedirectsResponse.md)
- [ListSchemaFieldsResponse](docs/Model/ListSchemaFieldsResponse.md)
- [PercentileDataPoint](docs/Model/PercentileDataPoint.md)
- [Pipeline](docs/Model/Pipeline.md)
- [PipelineStep](docs/Model/PipelineStep.md)
- [PipelineStepParamBinding](docs/Model/PipelineStepParamBinding.md)
- [PipelineType](docs/Model/PipelineType.md)
- [Promotion](docs/Model/Promotion.md)
- [PromotionCategory](docs/Model/PromotionCategory.md)
- [PromotionExclusion](docs/Model/PromotionExclusion.md)
- [PromotionFilterBoost](docs/Model/PromotionFilterBoost.md)
- [PromotionFilterCondition](docs/Model/PromotionFilterCondition.md)
- [PromotionPin](docs/Model/PromotionPin.md)
- [PromotionPinMode](docs/Model/PromotionPinMode.md)
- [PromotionRangeBoost](docs/Model/PromotionRangeBoost.md)
- [ProtobufAny](docs/Model/ProtobufAny.md)
- [ProtobufFieldMask](docs/Model/ProtobufFieldMask.md)
- [ProtobufNullValue](docs/Model/ProtobufNullValue.md)
- [QueryAggregateResult](docs/Model/QueryAggregateResult.md)
- [QueryAggregateResultAnalysis](docs/Model/QueryAggregateResultAnalysis.md)
- [QueryAggregateResultBuckets](docs/Model/QueryAggregateResultBuckets.md)
- [QueryAggregateResultBucketsBucket](docs/Model/QueryAggregateResultBucketsBucket.md)
- [QueryAggregateResultCount](docs/Model/QueryAggregateResultCount.md)
- [QueryAggregateResultDate](docs/Model/QueryAggregateResultDate.md)
- [QueryAggregateResultMetric](docs/Model/QueryAggregateResultMetric.md)
- [QueryAggregateResultPercentile](docs/Model/QueryAggregateResultPercentile.md)
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
- [Redirect](docs/Model/Redirect.md)
- [RedirectResult](docs/Model/RedirectResult.md)
- [SchemaField](docs/Model/SchemaField.md)
- [SchemaFieldMode](docs/Model/SchemaFieldMode.md)
- [SchemaFieldType](docs/Model/SchemaFieldType.md)
- [SendEventRequest](docs/Model/SendEventRequest.md)
- [SetDefaultPipelineRequest](docs/Model/SetDefaultPipelineRequest.md)
- [SetDefaultVersionRequest](docs/Model/SetDefaultVersionRequest.md)
- [Status](docs/Model/Status.md)
- [TextPosition](docs/Model/TextPosition.md)
- [UpdateRecordRequest](docs/Model/UpdateRecordRequest.md)
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

support@search.io

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v4`
  - Package version: `5.0.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
