# Sajari\CollectionsApi

All URIs are relative to https://api.search.io.

| Method                                                       | HTTP request                                             | Description       |
| ------------------------------------------------------------ | -------------------------------------------------------- | ----------------- |
| [**createCollection()**](CollectionsApi.md#createCollection) | **POST** /v4/collections                                 | Create collection |
| [**deleteCollection()**](CollectionsApi.md#deleteCollection) | **DELETE** /v4/collections/{collection_id}               | Delete collection |
| [**experiment()**](CollectionsApi.md#experiment)             | **POST** /v4/collections/{collection_id}:experiment      | Experiment        |
| [**getCollection()**](CollectionsApi.md#getCollection)       | **GET** /v4/collections/{collection_id}                  | Get collection    |
| [**listCollections()**](CollectionsApi.md#listCollections)   | **GET** /v4/collections                                  | List collections  |
| [**queryCollection()**](CollectionsApi.md#queryCollection)   | **POST** /v4/collections/{collection_id}:query           | Query collection  |
| [**queryCollection2()**](CollectionsApi.md#queryCollection2) | **POST** /v4/collections/{collection_id}:queryCollection | Query collection  |
| [**trackEvent()**](CollectionsApi.md#trackEvent)             | **POST** /v4/collections/{collection_id}:trackEvent      | Track event       |
| [**updateCollection()**](CollectionsApi.md#updateCollection) | **PATCH** /v4/collections/{collection_id}                | Update collection |

## `createCollection()`

```php
createCollection($collection_id, $collection, $account_id): \Sajari\Model\Collection
```

Create collection

Create an empty collection. Before records can be added to a collection, the schema and pipelines for the collection have to be set up. Consider setting up new collections via the Search.io Console, which handles the creation of the schema and pipelines for you.

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
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.

try {
  $result = $apiInstance->createCollection(
    $collection_id,
    $collection,
    $account_id
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->createCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                                   | Description                                                                                                                                                                                                                                          | Notes      |
| ----------------- | ------------------------------------------------------ | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id** | **string**                                             | The ID to use for the collection. This must start with an alphanumeric character followed by one or more alphanumeric or &#x60;-&#x60; characters. Strictly speaking, it must match the regular expression: &#x60;^[A-Za-z][a-za-z0-9\\-]\*\$&#x60;. |
| **collection**    | [**\Sajari\Model\Collection**](../Model/Collection.md) | Details of the collection to create.                                                                                                                                                                                                                 |
| **account_id**    | **string**                                             | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                                                                          | [optional] |

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
deleteCollection($collection_id, $account_id): mixed
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
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.

try {
  $result = $apiInstance->deleteCollection($collection_id, $account_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->deleteCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                 | Notes      |
| ----------------- | ---------- | --------------------------------------------------------------------------- | ---------- |
| **collection_id** | **string** | The collection to delete, e.g. &#x60;my-collection&#x60;.                   |
| **account_id**    | **string** | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;. | [optional] |

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

## `experiment()`

```php
experiment($collection_id, $experiment_request): \Sajari\Model\ExperimentResponse
```

Experiment

Run a query on a collection with a hypothetical configuration to see what kinds of results it produces. Saved promotions with a start date in the future are enabled during the experiment, unless they are explicitly disabled. The following example demonstrates how to run a simple experiment for a string, against a pipeline and with a proposed promotion: `json { \"pipeline\": { \"name\": \"my-pipeline\" }, \"variables\": { \"q\": \"search terms\" }, \"promotions\": [{ \"id\": \"1234\", \"condition\": \"q = 'search terms'\", \"pins\": [{ \"key\": { \"field\": \"id\", \"value\": \"54hdc7h2334h\" }, \"position\": 1 }] }] } `

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
$experiment_request = new \Sajari\Model\ExperimentRequest(); // \Sajari\Model\ExperimentRequest

try {
  $result = $apiInstance->experiment($collection_id, $experiment_request);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->experiment: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                   | Type                                                                 | Description                                              | Notes |
| ---------------------- | -------------------------------------------------------------------- | -------------------------------------------------------- | ----- |
| **collection_id**      | **string**                                                           | The collection to query, e.g. &#x60;my-collection&#x60;. |
| **experiment_request** | [**\Sajari\Model\ExperimentRequest**](../Model/ExperimentRequest.md) |                                                          |

### Return type

[**\Sajari\Model\ExperimentResponse**](../Model/ExperimentResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCollection()`

```php
getCollection($collection_id, $account_id, $view): \Sajari\Model\Collection
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
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.
$view = "VIEW_UNSPECIFIED"; // string | The amount of information to include in the retrieved pipeline.   - BASIC: Include basic information including display name and domains. This is the default value (for both [ListCollections](/docs/api#operation/ListCollections) and [GetCollection](/docs/api#operation/GetCollection)).  - FULL: Include the information from `BASIC`, plus full collection details like disk usage.

try {
  $result = $apiInstance->getCollection($collection_id, $account_id, $view);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->getCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                                                                                                                      | Notes                                              |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | -------------------------------------------------- |
| **collection_id** | **string** | The collection to retrieve, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                                                                                                                                      |
| **account_id**    | **string** | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                                                                                                                                                                                                                      | [optional]                                         |
| **view**          | **string** | The amount of information to include in the retrieved pipeline. - BASIC: Include basic information including display name and domains. This is the default value (for both [ListCollections](/docs/api#operation/ListCollections) and [GetCollection](/docs/api#operation/GetCollection)). - FULL: Include the information from &#x60;BASIC&#x60;, plus full collection details like disk usage. | [optional] [default to &#39;VIEW_UNSPECIFIED&#39;] |

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
listCollections($account_id, $page_size, $page_token, $view): \Sajari\Model\ListCollectionsResponse
```

List collections

Retrieve a list of collections in an account.

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
$account_id = "account_id_example"; // string | The account that owns this set of collections, e.g. `1618535966441231024`.
$page_size = 56; // int | The maximum number of collections to return. The service may return fewer than this value.  If unspecified, at most 50 collections are returned.  The maximum value is 100; values above 100 are coerced to 100.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListCollections](/docs/api#operation/ListCollections) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListCollections](/docs/api#operation/ListCollections) must match the call that provided the page token.
$view = "VIEW_UNSPECIFIED"; // string | The amount of information to include in each retrieved collection.   - BASIC: Include basic information including display name and domains. This is the default value (for both [ListCollections](/docs/api#operation/ListCollections) and [GetCollection](/docs/api#operation/GetCollection)).  - FULL: Include the information from `BASIC`, plus full collection details like disk usage.

try {
  $result = $apiInstance->listCollections(
    $account_id,
    $page_size,
    $page_token,
    $view
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->listCollections: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name           | Type       | Description                                                                                                                                                                                                                                                                                                                                                                                         | Notes                                              |
| -------------- | ---------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------- |
| **account_id** | **string** | The account that owns this set of collections, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                                                                                                                                                                                                                | [optional]                                         |
| **page_size**  | **int**    | The maximum number of collections to return. The service may return fewer than this value. If unspecified, at most 50 collections are returned. The maximum value is 100; values above 100 are coerced to 100.                                                                                                                                                                                      | [optional]                                         |
| **page_token** | **string** | A page token, received from a previous [ListCollections](/docs/api#operation/ListCollections) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListCollections](/docs/api#operation/ListCollections) must match the call that provided the page token.                                                                                        | [optional]                                         |
| **view**       | **string** | The amount of information to include in each retrieved collection. - BASIC: Include basic information including display name and domains. This is the default value (for both [ListCollections](/docs/api#operation/ListCollections) and [GetCollection](/docs/api#operation/GetCollection)). - FULL: Include the information from &#x60;BASIC&#x60;, plus full collection details like disk usage. | [optional] [default to &#39;VIEW_UNSPECIFIED&#39;] |

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
queryCollection($collection_id, $query_collection_request, $account_id): \Sajari\Model\QueryCollectionResponse
```

Query collection

Query the collection to search for records. The following example demonstrates how to run a simple search for a particular string: `json { \"variables\": { \"q\": \"search terms\" } } ` For more information: - See [filtering content](https://docs.search.io/documentation/fundamentals/integrating-search/filters-and-sort-options) - See [tracking in the Go SDK](https://github.com/sajari/sdk-go/blob/v2/session.go) - See [tracking in the JS SDK](https://github.com/sajari/sdk-js/blob/554e182e77d3ba99a9c100b208ebf3be414d2067/src/index.ts#L881) Note: Unlike other API calls, the `QueryCollection` call can be called from a browser. When called from a browser, the `Account-Id` header must be set to your account ID.

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
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.  Unlike other API calls, the `QueryCollection` call can be called from a browser. When called from a browser, the `Account-Id` header must be set to your account ID.

try {
  $result = $apiInstance->queryCollection(
    $collection_id,
    $query_collection_request,
    $account_id
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->queryCollection: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                         | Type                                                                           | Description                                                                                                                                                                                                                                                          | Notes      |
| ---------------------------- | ------------------------------------------------------------------------------ | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id**            | **string**                                                                     | The collection to query, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                             |
| **query_collection_request** | [**\Sajari\Model\QueryCollectionRequest**](../Model/QueryCollectionRequest.md) |                                                                                                                                                                                                                                                                      |
| **account_id**               | **string**                                                                     | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;. Unlike other API calls, the &#x60;QueryCollection&#x60; call can be called from a browser. When called from a browser, the &#x60;Account-Id&#x60; header must be set to your account ID. | [optional] |

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

## `queryCollection2()`

```php
queryCollection2($collection_id, $query_collection_request): \Sajari\Model\QueryCollectionResponse
```

Query collection

Query the collection to search for records. The following example demonstrates how to run a simple search for a particular string: `json { \"variables\": { \"q\": \"search terms\" } } ` For more information: - See [filtering content](https://docs.search.io/documentation/fundamentals/integrating-search/filters-and-sort-options) - See [tracking in the Go SDK](https://github.com/sajari/sdk-go/blob/v2/session.go) - See [tracking in the JS SDK](https://github.com/sajari/sdk-js/blob/554e182e77d3ba99a9c100b208ebf3be414d2067/src/index.ts#L881) Note: Unlike other API calls, the `QueryCollection` call can be called from a browser. When called from a browser, the `Account-Id` header must be set to your account ID.

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
  $result = $apiInstance->queryCollection2(
    $collection_id,
    $query_collection_request
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->queryCollection2: ",
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

## `trackEvent()`

```php
trackEvent($account_id, $collection_id, $event): object
```

Track event

Track an analytics event when a user interacts with an object returned by a [QueryCollection](/docs/api/#operation/QueryCollection) request. An analytics event can be tracked for the following objects: - Results - Promotion banners - Redirects When tracking redirect events, set `type` to `redirect`. - **Note:** You must pass an `Account-Id` header. - **Note:** One of `result_id`, `banner_id` or `redirect_id` are required.

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
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.
$collection_id = "collection_id_example"; // string | The collection to track the event against, e.g. `my-collection`.
$event = new \Sajari\Model\Event(); // \Sajari\Model\Event | The details of the event to track.

try {
  $result = $apiInstance->trackEvent($account_id, $collection_id, $event);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling CollectionsApi->trackEvent: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                         | Description                                                                 | Notes |
| ----------------- | -------------------------------------------- | --------------------------------------------------------------------------- | ----- |
| **account_id**    | **string**                                   | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;. |
| **collection_id** | **string**                                   | The collection to track the event against, e.g. &#x60;my-collection&#x60;.  |
| **event**         | [**\Sajari\Model\Event**](../Model/Event.md) | The details of the event to track.                                          |

### Return type

**object**

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
updateCollection($collection_id, $collection, $account_id, $update_mask): \Sajari\Model\Collection
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
$collection = new \Sajari\Model\Collection(); // \Sajari\Model\Collection | The details of the collection to update.
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.
$update_mask = "update_mask_example"; // string | The list of fields to update, separated by a comma, e.g. `authorized_query_domains,display_name`.  Each field should be in snake case.  For each field that you want to update, provide a corresponding value in the collection object containing the new value.

try {
  $result = $apiInstance->updateCollection(
    $collection_id,
    $collection,
    $account_id,
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

| Name              | Type                                                   | Description                                                                                                                                                                                                                                                              | Notes      |
| ----------------- | ------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ---------- |
| **collection_id** | **string**                                             | The collection to update, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                |
| **collection**    | [**\Sajari\Model\Collection**](../Model/Collection.md) | The details of the collection to update.                                                                                                                                                                                                                                 |
| **account_id**    | **string**                                             | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                                                                                              | [optional] |
| **update_mask**   | **string**                                             | The list of fields to update, separated by a comma, e.g. &#x60;authorized_query_domains,display_name&#x60;. Each field should be in snake case. For each field that you want to update, provide a corresponding value in the collection object containing the new value. | [optional] |

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
