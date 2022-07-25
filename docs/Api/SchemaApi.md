# Sajari\SchemaApi

All URIs are relative to https://api.search.io.

| Method                                                                | HTTP request                                                                | Description                |
| --------------------------------------------------------------------- | --------------------------------------------------------------------------- | -------------------------- |
| [**batchCreateSchemaFields()**](SchemaApi.md#batchCreateSchemaFields) | **POST** /v4/collections/{collection_id}/schemaFields:batchCreate           | Batch create schema fields |
| [**createSchemaField()**](SchemaApi.md#createSchemaField)             | **POST** /v4/collections/{collection_id}/schemaFields                       | Create schema field        |
| [**deleteSchemaField()**](SchemaApi.md#deleteSchemaField)             | **DELETE** /v4/collections/{collection_id}/schemaFields/{schema_field_name} | Delete schema field        |
| [**listSchemaFields()**](SchemaApi.md#listSchemaFields)               | **GET** /v4/collections/{collection_id}/schemaFields                        | List schema fields         |
| [**updateSchemaField()**](SchemaApi.md#updateSchemaField)             | **PATCH** /v4/collections/{collection_id}/schemaFields/{schema_field_name}  | Update schema field        |

## `batchCreateSchemaFields()`

```php
batchCreateSchemaFields($collection_id, $batch_create_schema_fields_request, $account_id): \Sajari\Model\BatchCreateSchemaFieldsResponse
```

Batch create schema fields

The batch version of the [CreateSchemaField](/docs/api#operation/CreateSchemaField) call.

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
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.

try {
  $result = $apiInstance->batchCreateSchemaFields(
    $collection_id,
    $batch_create_schema_fields_request,
    $account_id
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->batchCreateSchemaFields: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                                   | Type                                                                                           | Description                                                                    | Notes      |
| -------------------------------------- | ---------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------ | ---------- |
| **collection_id**                      | **string**                                                                                     | The collection to create the schema fields in, e.g. &#x60;my-collection&#x60;. |
| **batch_create_schema_fields_request** | [**\Sajari\Model\BatchCreateSchemaFieldsRequest**](../Model/BatchCreateSchemaFieldsRequest.md) |                                                                                |
| **account_id**                         | **string**                                                                                     | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.    | [optional] |

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
createSchemaField($collection_id, $schema_field, $parent, $account_id): \Sajari\Model\SchemaField
```

Create schema field

Create a new field in a collection's schema.

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
$parent = "parent_example"; // string | The parent resource where the schema field is to be created.  Format:   - accounts/{account}/collections/{collection}   - accounts/{account}/collections/{collection}/schemaFields/{schemaField}
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.

try {
  $result = $apiInstance->createSchemaField(
    $collection_id,
    $schema_field,
    $parent,
    $account_id
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->createSchemaField: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                                     | Description                                                                                                                                                                                 | Notes      |
| ----------------- | -------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id** | **string**                                               | The collection to create a schema field in, e.g. &#x60;my-collection&#x60;.                                                                                                                 |
| **schema_field**  | [**\Sajari\Model\SchemaField**](../Model/SchemaField.md) | The schema field to create.                                                                                                                                                                 |
| **parent**        | **string**                                               | The parent resource where the schema field is to be created. Format: - accounts/{account}/collections/{collection} - accounts/{account}/collections/{collection}/schemaFields/{schemaField} | [optional] |
| **account_id**    | **string**                                               | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                 | [optional] |

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

## `deleteSchemaField()`

```php
deleteSchemaField($collection_id, $schema_field_name, $account_id): mixed
```

Delete schema field

Deleting a schema field removes it from all records within the collection, however, references to the schema field in pipelines are not removed. > Note: This operation cannot be reversed.

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
$collection_id = "collection_id_example"; // string | The collection the schema field belongs to, e.g. `my-collection`.
$schema_field_name = "schema_field_name_example"; // string | The name of the schema field to delete.
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.

try {
  $result = $apiInstance->deleteSchemaField(
    $collection_id,
    $schema_field_name,
    $account_id
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->deleteSchemaField: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                  | Type       | Description                                                                 | Notes      |
| --------------------- | ---------- | --------------------------------------------------------------------------- | ---------- |
| **collection_id**     | **string** | The collection the schema field belongs to, e.g. &#x60;my-collection&#x60;. |
| **schema_field_name** | **string** | The name of the schema field to delete.                                     |
| **account_id**        | **string** | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;. | [optional] |

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

## `listSchemaFields()`

```php
listSchemaFields($collection_id, $parent, $account_id, $page_size, $page_token): \Sajari\Model\ListSchemaFieldsResponse
```

List schema fields

Retrieve a list of schema fields in a collection.

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
$parent = "parent_example"; // string | The parent to list schema fields from.  Format:   - accounts/{account}/collections/{collection}   - accounts/{account}/collections/{collection}/schemaFields/{schemaField}
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.
$page_size = 56; // int | The maximum number of schema fields to return. The service may return fewer than this value.  If unspecified, at most 50 schema fields are returned.  The maximum value is 1000; values above 1000 are coerced to 1000.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListSchemaFields](/docs/api#operation/ListSchemaFields) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListSchemaFields](/docs/api#operation/ListSchemaFields) must match the call that provided the page token.

try {
  $result = $apiInstance->listSchemaFields(
    $collection_id,
    $parent,
    $account_id,
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

| Name              | Type       | Description                                                                                                                                                                                                                                                                                                      | Notes      |
| ----------------- | ---------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id** | **string** | The collection that owns this set of schema fields, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                              |
| **parent**        | **string** | The parent to list schema fields from. Format: - accounts/{account}/collections/{collection} - accounts/{account}/collections/{collection}/schemaFields/{schemaField}                                                                                                                                            | [optional] |
| **account_id**    | **string** | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                                                                                                                                      | [optional] |
| **page_size**     | **int**    | The maximum number of schema fields to return. The service may return fewer than this value. If unspecified, at most 50 schema fields are returned. The maximum value is 1000; values above 1000 are coerced to 1000.                                                                                            | [optional] |
| **page_token**    | **string** | A page token, received from a previous [ListSchemaFields](/docs/api#operation/ListSchemaFields) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListSchemaFields](/docs/api#operation/ListSchemaFields) must match the call that provided the page token. | [optional] |

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

## `updateSchemaField()`

```php
updateSchemaField($collection_id, $schema_field_name, $schema_field, $account_id, $update_mask): \Sajari\Model\SchemaField
```

Update schema field

Update the details of a schema field. Only `name` and `description` can be updated.

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
$collection_id = "collection_id_example"; // string | The collection the schema field belongs to, e.g. `my-collection`.
$schema_field_name = "schema_field_name_example"; // string | The name of the schema field to update.
$schema_field = new \Sajari\Model\SchemaField(); // \Sajari\Model\SchemaField | The schema field details to update.
$account_id = "account_id_example"; // string | The account that owns the collection, e.g. `1618535966441231024`.
$update_mask = "update_mask_example"; // string | The list of fields to update, separated by a comma, e.g. `name,description`.  Each field should be in snake case.  For each field that you want to update, provide a corresponding value in the schema field object containing the new value.

try {
  $result = $apiInstance->updateSchemaField(
    $collection_id,
    $schema_field_name,
    $schema_field,
    $account_id,
    $update_mask
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling SchemaApi->updateSchemaField: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                  | Type                                                     | Description                                                                                                                                                                                                                                           | Notes      |
| --------------------- | -------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id**     | **string**                                               | The collection the schema field belongs to, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                           |
| **schema_field_name** | **string**                                               | The name of the schema field to update.                                                                                                                                                                                                               |
| **schema_field**      | [**\Sajari\Model\SchemaField**](../Model/SchemaField.md) | The schema field details to update.                                                                                                                                                                                                                   |
| **account_id**        | **string**                                               | The account that owns the collection, e.g. &#x60;1618535966441231024&#x60;.                                                                                                                                                                           | [optional] |
| **update_mask**       | **string**                                               | The list of fields to update, separated by a comma, e.g. &#x60;name,description&#x60;. Each field should be in snake case. For each field that you want to update, provide a corresponding value in the schema field object containing the new value. | [optional] |

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
