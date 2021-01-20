# Sajari\SchemaApi

All URIs are relative to https://api-gateway.sajari.com.

| Method                                                                | HTTP request                                                      | Description                |
| --------------------------------------------------------------------- | ----------------------------------------------------------------- | -------------------------- |
| [**batchCreateSchemaFields()**](SchemaApi.md#batchCreateSchemaFields) | **POST** /v4/collections/{collection_id}/schemaFields:batchCreate | Batch create schema fields |
| [**createSchemaField()**](SchemaApi.md#createSchemaField)             | **POST** /v4/collections/{collection_id}/schemaFields             | Create schema field        |
| [**listSchemaFields()**](SchemaApi.md#listSchemaFields)               | **GET** /v4/collections/{collection_id}/schemaFields              | List schema fields         |

## `batchCreateSchemaFields()`

```php
batchCreateSchemaFields($collection_id, $batch_create_schema_fields_request): \Sajari\Model\BatchCreateSchemaFieldsResponse
```

Batch create schema fields

The batch version of the [CreateSchemaField](/api#operation/CreateSchemaField) call.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\SchemaApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to create the schema fields in, e.g. `my-collection`.
$batch_create_schema_fields_request = new \Sajari\Model\BatchCreateSchemaFieldsRequest(); // \Sajari\Model\BatchCreateSchemaFieldsRequest

try {
  $result = $apiInstance->batchCreateSchemaFields(
    $collection_id,
    $batch_create_schema_fields_request
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->batchCreateSchemaFields: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                                   | Type                                                                                           | Description                                                                    | Notes |
| -------------------------------------- | ---------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------ | ----- |
| **collection_id**                      | **string**                                                                                     | The collection to create the schema fields in, e.g. &#x60;my-collection&#x60;. |
| **batch_create_schema_fields_request** | [**\Sajari\Model\BatchCreateSchemaFieldsRequest**](../Model/BatchCreateSchemaFieldsRequest.md) |                                                                                |

### Return type

[**\Sajari\Model\BatchCreateSchemaFieldsResponse**](../Model/BatchCreateSchemaFieldsResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createSchemaField()`

```php
createSchemaField($collection_id, $schema_field): \Sajari\Model\SchemaField
```

Create schema field

Create a new field in your collection's schema.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\SchemaApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to create a schema field in, e.g. `my-collection`.
$schema_field = new \Sajari\Model\SchemaField(); // \Sajari\Model\SchemaField | The schema field to create.

try {
  $result = $apiInstance->createSchemaField($collection_id, $schema_field);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->createSchemaField: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                                     | Description                                                                 | Notes |
| ----------------- | -------------------------------------------------------- | --------------------------------------------------------------------------- | ----- |
| **collection_id** | **string**                                               | The collection to create a schema field in, e.g. &#x60;my-collection&#x60;. |
| **schema_field**  | [**\Sajari\Model\SchemaField**](../Model/SchemaField.md) | The schema field to create.                                                 |

### Return type

[**\Sajari\Model\SchemaField**](../Model/SchemaField.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSchemaFields()`

```php
listSchemaFields($collection_id, $page_size, $page_token): \Sajari\Model\ListSchemaFieldsResponse
```

List schema fields

Retrieve a list of schema fields in the collection.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\SchemaApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns this set of schema fields, e.g. `my-collection`.
$page_size = 56; // int | The maximum number of schema fields to return. The service may return fewer than this value.  If unspecified, at most 50 schema fields are returned.  The maximum value is 1000; values above 1000 are coerced to 1000.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListSchemaFields](/api#operation/ListSchemaFields) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListSchemaFields](/api#operation/ListSchemaFields) must match the call that provided the page token.

try {
  $result = $apiInstance->listSchemaFields(
    $collection_id,
    $page_size,
    $page_token
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->listSchemaFields: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                            | Notes      |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ---------- |
| **collection_id** | **string** | The collection that owns this set of schema fields, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                    |
| **page_size**     | **int**    | The maximum number of schema fields to return. The service may return fewer than this value. If unspecified, at most 50 schema fields are returned. The maximum value is 1000; values above 1000 are coerced to 1000.                                                                                  | [optional] |
| **page_token**    | **string** | A page token, received from a previous [ListSchemaFields](/api#operation/ListSchemaFields) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListSchemaFields](/api#operation/ListSchemaFields) must match the call that provided the page token. | [optional] |

### Return type

[**\Sajari\Model\ListSchemaFieldsResponse**](../Model/ListSchemaFieldsResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
