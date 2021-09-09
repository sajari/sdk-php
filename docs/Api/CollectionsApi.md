# Sajari\CollectionsApi

All URIs are relative to https://api-gateway.sajari.com.

| Method                                                       | HTTP request                                             | Description       |
| ------------------------------------------------------------ | -------------------------------------------------------- | ----------------- |
| [**createCollection()**](CollectionsApi.md#createCollection) | **POST** /v4/collections                                 | Create collection |
| [**deleteCollection()**](CollectionsApi.md#deleteCollection) | **DELETE** /v4/collections/{collection_id}               | Delete collection |
| [**getCollection()**](CollectionsApi.md#getCollection)       | **GET** /v4/collections/{collection_id}                  | Get collection    |
| [**listCollections()**](CollectionsApi.md#listCollections)   | **GET** /v4/collections                                  | List collections  |
| [**queryCollection()**](CollectionsApi.md#queryCollection)   | **POST** /v4/collections/{collection_id}:queryCollection | Query collection  |
| [**updateCollection()**](CollectionsApi.md#updateCollection) | **PATCH** /v4/collections/{collection_id}                | Update collection |

## `createCollection()`

```php
createCollection($collection_id, $collection): \Sajari\Model\Collection
```

Create collection

Create an empty collection. Before records can be added to a collection, the schema and pipelines for the collection have to be set up. Consider setting up new collections via the Sajari Console, which handles the creation of the schema and pipelines for you.

### Example

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

### Parameters

| Name              | Type                                                   | Description                                                                                                                                                                                                                                          | Notes |
| ----------------- | ------------------------------------------------------ | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----- |
| **collection_id** | **string**                                             | The ID to use for the collection. This must start with an alphanumeric character followed by one or more alphanumeric or &#x60;-&#x60; characters. Strictly speaking, it must match the regular expression: &#x60;^[A-Za-z][a-za-z0-9\\-]\*\$&#x60;. |
| **collection**    | [**\Sajari\Model\Collection**](../Model/Collection.md) | Details of the collection to create.                                                                                                                                                                                                                 |

### Return type

[**\Sajari\Model\Collection**](../Model/Collection.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteCollection()`

```php
deleteCollection($collection_id): mixed
```

Delete collection

Delete a collection and all of its associated data. > Note: This operation cannot be reversed.

### Example

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
$collection_id = "collection_id_example"; // string | The collection to delete, e.g. `my-collection`.

try {
  $result = $apiInstance->deleteCollection($collection_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->deleteCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                               | Notes |
| ----------------- | ---------- | --------------------------------------------------------- | ----- |
| **collection_id** | **string** | The collection to delete, e.g. &#x60;my-collection&#x60;. |

### Return type

**mixed**

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCollection()`

```php
getCollection($collection_id): \Sajari\Model\Collection
```

Get collection

Retrieve the details of a collection.

### Example

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
$collection_id = "collection_id_example"; // string | The collection to retrieve, e.g. `my-collection`.

try {
  $result = $apiInstance->getCollection($collection_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->getCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                 | Notes |
| ----------------- | ---------- | ----------------------------------------------------------- | ----- |
| **collection_id** | **string** | The collection to retrieve, e.g. &#x60;my-collection&#x60;. |

### Return type

[**\Sajari\Model\Collection**](../Model/Collection.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCollections()`

```php
listCollections($page_size, $page_token): \Sajari\Model\ListCollectionsResponse
```

List collections

Retrieve a list of collections in the account.

### Example

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
$page_size = 56; // int | The maximum number of collections to return. The service may return fewer than this value.  If unspecified, at most 50 collections are returned.  The maximum value is 100; values above 100 are coerced to 100.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListCollections](/api#operation/ListCollections) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListCollections](/api#operation/ListCollections) must match the call that provided the page token.

try {
  $result = $apiInstance->listCollections($page_size, $page_token);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->listCollections: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name           | Type       | Description                                                                                                                                                                                                                                                                                        | Notes      |
| -------------- | ---------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **page_size**  | **int**    | The maximum number of collections to return. The service may return fewer than this value. If unspecified, at most 50 collections are returned. The maximum value is 100; values above 100 are coerced to 100.                                                                                     | [optional] |
| **page_token** | **string** | A page token, received from a previous [ListCollections](/api#operation/ListCollections) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListCollections](/api#operation/ListCollections) must match the call that provided the page token. | [optional] |

### Return type

[**\Sajari\Model\ListCollectionsResponse**](../Model/ListCollectionsResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `queryCollection()`

```php
queryCollection($collection_id, $query_collection_request): \Sajari\Model\QueryCollectionResponse
```

Query collection

Query the collection to search for records. The following example demonstrates how to run a simple search for a particular string: `json { \"variables\": { \"q\": \"search terms\" } } ` For more information: - See [filtering content](https://docs.sajari.com/user-guide/integrating-search/filters/) - See [tracking in the Go SDK](https://github.com/sajari/sdk-go/blob/v2/session.go) - See [tracking in the JS SDK](https://github.com/sajari/sajari-sdk-js/blob/master/src/session.ts)

### Example

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
$collection_id = "collection_id_example"; // string | The collection to query, e.g. `my-collection`.
$query_collection_request = new \Sajari\Model\QueryCollectionRequest(); // \Sajari\Model\QueryCollectionRequest

try {
  $result = $apiInstance->queryCollection(
    $collection_id,
    $query_collection_request
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->queryCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                         | Type                                                                           | Description                                              | Notes |
| ---------------------------- | ------------------------------------------------------------------------------ | -------------------------------------------------------- | ----- |
| **collection_id**            | **string**                                                                     | The collection to query, e.g. &#x60;my-collection&#x60;. |
| **query_collection_request** | [**\Sajari\Model\QueryCollectionRequest**](../Model/QueryCollectionRequest.md) |                                                          |

### Return type

[**\Sajari\Model\QueryCollectionResponse**](../Model/QueryCollectionResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateCollection()`

```php
updateCollection($collection_id, $collection, $update_mask): \Sajari\Model\Collection
```

Update collection

Update the details of a collection.

### Example

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
$collection_id = "collection_id_example"; // string | The collection to update, e.g. `my-collection`.
$collection = new \Sajari\Model\Collection(); // \Sajari\Model\Collection | Details of the collection to update.
$update_mask = "update_mask_example"; // string | The list of fields to be updated, separated by a comma, e.g. `field1,field2`.  Each field should be in snake case, e.g. `display_name`.  For each field that you want to update, provide a corresponding value in the collection object containing the new value.

try {
  $result = $apiInstance->updateCollection(
    $collection_id,
    $collection,
    $update_mask
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->updateCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                                   | Description                                                                                                                                                                                                                                                                         | Notes      |
| ----------------- | ------------------------------------------------------ | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id** | **string**                                             | The collection to update, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                           |
| **collection**    | [**\Sajari\Model\Collection**](../Model/Collection.md) | Details of the collection to update.                                                                                                                                                                                                                                                |
| **update_mask**   | **string**                                             | The list of fields to be updated, separated by a comma, e.g. &#x60;field1,field2&#x60;. Each field should be in snake case, e.g. &#x60;display_name&#x60;. For each field that you want to update, provide a corresponding value in the collection object containing the new value. | [optional] |

### Return type

[**\Sajari\Model\Collection**](../Model/Collection.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
