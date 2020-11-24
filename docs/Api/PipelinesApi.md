# Sajari\PipelinesApi

All URIs are relative to https://api-gateway.sajari.com.

| Method                                                         | HTTP request                                                                       | Description                  |
| -------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------- |
| [**createPipeline()**](PipelinesApi.md#createPipeline)         | **POST** /v4/collections/{collection_id}/pipelines                                 | Create pipeline              |
| [**generatePipelines()**](PipelinesApi.md#generatePipelines)   | **POST** /v4/collections/{collection_id}:generatePipelines                         | Generate pipelines           |
| [**getDefaultPipeline()**](PipelinesApi.md#getDefaultPipeline) | **GET** /v4/collections/{collection_id}:getDefaultPipeline                         | Get default pipeline         |
| [**getDefaultVersion()**](PipelinesApi.md#getDefaultVersion)   | **GET** /v4/collections/{collection_id}/pipelines/{type}/{name}:getDefaultVersion  | Get default pipeline version |
| [**getPipeline()**](PipelinesApi.md#getPipeline)               | **GET** /v4/collections/{collection_id}/pipelines/{type}/{name}/{version}          | Get pipeline                 |
| [**listPipelines()**](PipelinesApi.md#listPipelines)           | **GET** /v4/collections/{collection_id}/pipelines                                  | List pipelines               |
| [**setDefaultPipeline()**](PipelinesApi.md#setDefaultPipeline) | **POST** /v4/collections/{collection_id}:setDefaultPipeline                        | Set default pipeline         |
| [**setDefaultVersion()**](PipelinesApi.md#setDefaultVersion)   | **POST** /v4/collections/{collection_id}/pipelines/{type}/{name}:setDefaultVersion | Set default pipeline version |

## `createPipeline()`

```php
createPipeline($collection_id, $pipeline): \Sajari\Model\Pipeline
```

Create pipeline

Create a new pipeline. Pipelines are immutable once created. If you want to change a pipeline e.g. to add or change some steps, you need to create a new version of that pipeline. To start using a new pipeline you need to update your record ingestion calls and/or your query calls to specify the new pipeline. To create the pipeline from YAML, set the request's `Content-Type` header to `application/yaml` and submit the pipeline's YAML in the request body.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to create the pipeline in, e.g. `my-collection`.
$pipeline = new \Sajari\Model\Pipeline(); // \Sajari\Model\Pipeline | The pipeline to create.

try {
  $result = $apiInstance->createPipeline($collection_id, $pipeline);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->createPipeline: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                               | Description                                                               | Notes |
| ----------------- | -------------------------------------------------- | ------------------------------------------------------------------------- | ----- |
| **collection_id** | **string**                                         | The collection to create the pipeline in, e.g. &#x60;my-collection&#x60;. |
| **pipeline**      | [**\Sajari\Model\Pipeline**](../Model/Pipeline.md) | The pipeline to create.                                                   |

### Return type

[**\Sajari\Model\Pipeline**](../Model/Pipeline.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/yaml`
- **Accept**: `application/json`, `application/yaml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `generatePipelines()`

```php
generatePipelines($collection_id, $generate_pipelines_request): \Sajari\Model\GeneratePipelinesResponse
```

Generate pipelines

Generate basic record, query and autocomplete pipeline templates. Use these templates as a starting point for your collection's pipelines. This call returns a set of pipelines that you can pass directly to the create pipeline call. The generated templates can be returned in JSON, the default, or YAML. To return the generated pipelines in YAML, set the request's `Accept` header to `application/yaml`. The three pipelines in the YAML response are separated by three dashes (`---`).

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection, e.g. `my-collection`.
$generate_pipelines_request = new \Sajari\Model\GeneratePipelinesRequest(); // \Sajari\Model\GeneratePipelinesRequest

try {
  $result = $apiInstance->generatePipelines(
    $collection_id,
    $generate_pipelines_request
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->generatePipelines: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                           | Type                                                                               | Description                                     | Notes |
| ------------------------------ | ---------------------------------------------------------------------------------- | ----------------------------------------------- | ----- |
| **collection_id**              | **string**                                                                         | The collection, e.g. &#x60;my-collection&#x60;. |
| **generate_pipelines_request** | [**\Sajari\Model\GeneratePipelinesRequest**](../Model/GeneratePipelinesRequest.md) |                                                 |

### Return type

[**\Sajari\Model\GeneratePipelinesResponse**](../Model/GeneratePipelinesResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/yaml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDefaultPipeline()`

```php
getDefaultPipeline($collection_id, $type): \Sajari\Model\GetDefaultPipelineResponse
```

Get default pipeline

Get the default pipeline for a collection. Every collection has a default record pipeline and a default query pipeline. When a pipeline is required to complete an operation, it can be omitted from the request if a default pipeline has been set. When adding a record to a collection, the default record pipeline is used if none is provided. When querying a collection, the default query pipeline is used if none is provided.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to get the default query pipeline of, e.g. `my-collection`.
$type = "TYPE_UNSPECIFIED"; // string | The type of the pipeline to get.   - TYPE_UNSPECIFIED: Pipeline type not specified.  - RECORD: Record pipeline.  - QUERY: Query pipeline.

try {
  $result = $apiInstance->getDefaultPipeline($collection_id, $type);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->getDefaultPipeline: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                           | Notes                                   |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------- |
| **collection_id** | **string** | The collection to get the default query pipeline of, e.g. &#x60;my-collection&#x60;.                                                  |
| **type**          | **string** | The type of the pipeline to get. - TYPE_UNSPECIFIED: Pipeline type not specified. - RECORD: Record pipeline. - QUERY: Query pipeline. | [default to &#39;TYPE_UNSPECIFIED&#39;] |

### Return type

[**\Sajari\Model\GetDefaultPipelineResponse**](../Model/GetDefaultPipelineResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDefaultVersion()`

```php
getDefaultVersion($collection_id, $type, $name, $view): \Sajari\Model\Pipeline
```

Get default pipeline version

Get the default version for a given pipeline. The default version of a pipeline is used when a pipeline is referred to without specifying a version. This allows you to change the pipeline version used for requests without having to change your code. To retrieve the pipeline in YAML, set the request's `Accept` header to `application/yaml`.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns the pipeline to get the default version of, e.g. `my-collection`.
$type = "type_example"; // string | The type of the pipeline to get the default version of.
$name = "name_example"; // string | The name of the pipeline to get the default version of, e.g. `my-pipeline`.
$view = "VIEW_UNSPECIFIED"; // string | The amount of information to include in the retrieved pipeline.   - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the `BASIC` view.  - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/docs/api-reference#operation/ListPipelines) and [GetPipeline](/docs/api-reference#operation/GetPipeline)).  - FULL: Include the information from `BASIC`, plus full step configuration.

try {
  $result = $apiInstance->getDefaultVersion(
    $collection_id,
    $type,
    $name,
    $view
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->getDefaultVersion: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                | Notes                                              |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | -------------------------------------------------- |
| **collection_id** | **string** | The collection that owns the pipeline to get the default version of, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                                                                                                                                                                                                                                       |
| **type**          | **string** | The type of the pipeline to get the default version of.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| **name**          | **string** | The name of the pipeline to get the default version of, e.g. &#x60;my-pipeline&#x60;.                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| **view**          | **string** | The amount of information to include in the retrieved pipeline. - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the &#x60;BASIC&#x60; view. - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/docs/api-reference#operation/ListPipelines) and [GetPipeline](/docs/api-reference#operation/GetPipeline)). - FULL: Include the information from &#x60;BASIC&#x60;, plus full step configuration. | [optional] [default to &#39;VIEW_UNSPECIFIED&#39;] |

### Return type

[**\Sajari\Model\Pipeline**](../Model/Pipeline.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/yaml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPipeline()`

```php
getPipeline($collection_id, $type, $name, $version, $view): \Sajari\Model\Pipeline
```

Get pipeline

Retrieve the details of a pipeline. Supply the type, name and version. To retrieve the pipeline in YAML, set the request's `Accept` header to `application/yaml`.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns the pipeline, e.g. `my-collection`.
$type = "type_example"; // string | The type of the pipeline to retrieve.
$name = "name_example"; // string | The name of the pipeline to retrieve, e.g. `my-pipeline`.
$version = "version_example"; // string | The version of the pipeline to retrieve, e.g. `42`.
$view = "VIEW_UNSPECIFIED"; // string | The amount of information to include in the retrieved pipeline.   - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the `BASIC` view.  - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/docs/api-reference#operation/ListPipelines) and [GetPipeline](/docs/api-reference#operation/GetPipeline)).  - FULL: Include the information from `BASIC`, plus full step configuration.

try {
  $result = $apiInstance->getPipeline(
    $collection_id,
    $type,
    $name,
    $version,
    $view
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->getPipeline: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                | Notes                                              |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | -------------------------------------------------- |
| **collection_id** | **string** | The collection that owns the pipeline, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| **type**          | **string** | The type of the pipeline to retrieve.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| **name**          | **string** | The name of the pipeline to retrieve, e.g. &#x60;my-pipeline&#x60;.                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| **version**       | **string** | The version of the pipeline to retrieve, e.g. &#x60;42&#x60;.                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| **view**          | **string** | The amount of information to include in the retrieved pipeline. - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the &#x60;BASIC&#x60; view. - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/docs/api-reference#operation/ListPipelines) and [GetPipeline](/docs/api-reference#operation/GetPipeline)). - FULL: Include the information from &#x60;BASIC&#x60;, plus full step configuration. | [optional] [default to &#39;VIEW_UNSPECIFIED&#39;] |

### Return type

[**\Sajari\Model\Pipeline**](../Model/Pipeline.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/yaml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listPipelines()`

```php
listPipelines($collection_id, $page_size, $page_token, $view): \Sajari\Model\ListPipelinesResponse
```

List pipelines

Retrieve a list of pipelines.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns this set of pipelines, e.g. `my-collection`.
$page_size = 56; // int | The maximum number of pipelines to return. The service may return fewer than this value.  If unspecified, at most 50 pipelines are returned.  The maximum value is 1000; values above 1000 are coerced to 1000.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListPipelines](/docs/api-reference#operation/ListPipelines) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListPipelines](/docs/api-reference#operation/ListPipelines) must match the call that provided the page token.
$view = "VIEW_UNSPECIFIED"; // string | The amount of information to include in each retrieved pipeline.   - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the `BASIC` view.  - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/docs/api-reference#operation/ListPipelines) and [GetPipeline](/docs/api-reference#operation/GetPipeline)).  - FULL: Include the information from `BASIC`, plus full step configuration.

try {
  $result = $apiInstance->listPipelines(
    $collection_id,
    $page_size,
    $page_token,
    $view
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->listPipelines: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 | Notes                                              |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------- |
| **collection_id** | **string** | The collection that owns this set of pipelines, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **page_size**     | **int**    | The maximum number of pipelines to return. The service may return fewer than this value. If unspecified, at most 50 pipelines are returned. The maximum value is 1000; values above 1000 are coerced to 1000.                                                                                                                                                                                                                                                                                                                               | [optional]                                         |
| **page_token**    | **string** | A page token, received from a previous [ListPipelines](/docs/api-reference#operation/ListPipelines) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListPipelines](/docs/api-reference#operation/ListPipelines) must match the call that provided the page token.                                                                                                                                                                                                                    | [optional]                                         |
| **view**          | **string** | The amount of information to include in each retrieved pipeline. - VIEW_UNSPECIFIED: The default / unset value. The API defaults to the &#x60;BASIC&#x60; view. - BASIC: Include basic information including type, name, version and description but not the full step configuration. This is the default value (for both [ListPipelines](/docs/api-reference#operation/ListPipelines) and [GetPipeline](/docs/api-reference#operation/GetPipeline)). - FULL: Include the information from &#x60;BASIC&#x60;, plus full step configuration. | [optional] [default to &#39;VIEW_UNSPECIFIED&#39;] |

### Return type

[**\Sajari\Model\ListPipelinesResponse**](../Model/ListPipelinesResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setDefaultPipeline()`

```php
setDefaultPipeline($collection_id, $set_default_pipeline_request): object
```

Set default pipeline

Set the default pipeline for a collection. Every collection has a default record pipeline and a default query pipeline. When a pipeline is required to complete an operation, it can be omitted from the request if a default pipeline has been set. When adding a record to a collection, the default record pipeline is used if none is provided. When querying a collection, the default query pipeline is used if none is provided. Once a default pipeline has been set it cannot be cleared, only set to another pipeline.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to set the default query pipeline of, e.g. `my-collection`.
$set_default_pipeline_request = new \Sajari\Model\SetDefaultPipelineRequest(); // \Sajari\Model\SetDefaultPipelineRequest

try {
  $result = $apiInstance->setDefaultPipeline(
    $collection_id,
    $set_default_pipeline_request
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->setDefaultPipeline: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                             | Type                                                                                 | Description                                                                          | Notes |
| -------------------------------- | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ----- |
| **collection_id**                | **string**                                                                           | The collection to set the default query pipeline of, e.g. &#x60;my-collection&#x60;. |
| **set_default_pipeline_request** | [**\Sajari\Model\SetDefaultPipelineRequest**](../Model/SetDefaultPipelineRequest.md) |                                                                                      |

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

## `setDefaultVersion()`

```php
setDefaultVersion($collection_id, $type, $name, $set_default_version_request): object
```

Set default pipeline version

Set the default version for a given pipeline. The default version of a pipeline is used when a pipeline is referred to without specifying a version. This allows you to change the pipeline version used for requests without having to change your code.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PipelinesApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns the pipeline to set the default version of, e.g. `my-collection`.
$type = "type_example"; // string | The type of the pipeline to set the default version of.
$name = "name_example"; // string | The name of the pipeline to set the default version of, e.g. `my-pipeline`.
$set_default_version_request = new \Sajari\Model\SetDefaultVersionRequest(); // \Sajari\Model\SetDefaultVersionRequest

try {
  $result = $apiInstance->setDefaultVersion(
    $collection_id,
    $type,
    $name,
    $set_default_version_request
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PipelinesApi->setDefaultVersion: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                            | Type                                                                               | Description                                                                                          | Notes |
| ------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ----- |
| **collection_id**               | **string**                                                                         | The collection that owns the pipeline to set the default version of, e.g. &#x60;my-collection&#x60;. |
| **type**                        | **string**                                                                         | The type of the pipeline to set the default version of.                                              |
| **name**                        | **string**                                                                         | The name of the pipeline to set the default version of, e.g. &#x60;my-pipeline&#x60;.                |
| **set_default_version_request** | [**\Sajari\Model\SetDefaultVersionRequest**](../Model/SetDefaultVersionRequest.md) |                                                                                                      |

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
