# Sajari\RedirectsApi

All URIs are relative to https://api.search.io.

| Method                                                 | HTTP request                                                       | Description     |
| ------------------------------------------------------ | ------------------------------------------------------------------ | --------------- |
| [**createRedirect()**](RedirectsApi.md#createRedirect) | **POST** /v4/collections/{collection_id}/redirects                 | Create redirect |
| [**deleteRedirect()**](RedirectsApi.md#deleteRedirect) | **DELETE** /v4/collections/{collection_id}/redirects/{redirect_id} | Delete redirect |
| [**getRedirect()**](RedirectsApi.md#getRedirect)       | **GET** /v4/collections/{collection_id}/redirects/{redirect_id}    | Get redirect    |
| [**listRedirects()**](RedirectsApi.md#listRedirects)   | **GET** /v4/collections/{collection_id}/redirects                  | List redirects  |
| [**updateRedirect()**](RedirectsApi.md#updateRedirect) | **PATCH** /v4/collections/{collection_id}/redirects/{redirect_id}  | Update redirect |

## `createRedirect()`

```php
createRedirect($collection_id, $redirect): \Sajari\Model\Redirect
```

Create redirect

Create a new redirect in a collection.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\RedirectsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to create a redirect in, e.g. `my-collection`.
$redirect = new \Sajari\Model\Redirect(); // \Sajari\Model\Redirect | The redirect to create.

try {
  $result = $apiInstance->createRedirect($collection_id, $redirect);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling RedirectsApi->createRedirect: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                               | Description                                                             | Notes |
| ----------------- | -------------------------------------------------- | ----------------------------------------------------------------------- | ----- |
| **collection_id** | **string**                                         | The collection to create a redirect in, e.g. &#x60;my-collection&#x60;. |
| **redirect**      | [**\Sajari\Model\Redirect**](../Model/Redirect.md) | The redirect to create.                                                 |

### Return type

[**\Sajari\Model\Redirect**](../Model/Redirect.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteRedirect()`

```php
deleteRedirect($collection_id, $redirect_id): mixed
```

Delete redirect

Delete a redirect and all of its associated data. > Note: This operation cannot be reversed.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\RedirectsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection the redirect belongs to, e.g. `my-collection`.
$redirect_id = "redirect_id_example"; // string | The redirect to delete, e.g. `1234`.

try {
  $result = $apiInstance->deleteRedirect($collection_id, $redirect_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling RedirectsApi->deleteRedirect: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                             | Notes |
| ----------------- | ---------- | ----------------------------------------------------------------------- | ----- |
| **collection_id** | **string** | The collection the redirect belongs to, e.g. &#x60;my-collection&#x60;. |
| **redirect_id**   | **string** | The redirect to delete, e.g. &#x60;1234&#x60;.                          |

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

## `getRedirect()`

```php
getRedirect($collection_id, $redirect_id): \Sajari\Model\Redirect
```

Get redirect

Retrieve the details of a redirect.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\RedirectsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns the redirect, e.g. `my-collection`.
$redirect_id = "redirect_id_example"; // string | The redirect to retrieve, e.g. `1234`.

try {
  $result = $apiInstance->getRedirect($collection_id, $redirect_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling RedirectsApi->getRedirect: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                            | Notes |
| ----------------- | ---------- | ---------------------------------------------------------------------- | ----- |
| **collection_id** | **string** | The collection that owns the redirect, e.g. &#x60;my-collection&#x60;. |
| **redirect_id**   | **string** | The redirect to retrieve, e.g. &#x60;1234&#x60;.                       |

### Return type

[**\Sajari\Model\Redirect**](../Model/Redirect.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listRedirects()`

```php
listRedirects($collection_id, $page_size, $page_token): \Sajari\Model\ListRedirectsResponse
```

List redirects

Retrieve a list of redirects in a collection.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\RedirectsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns this set of redirects, e.g. `my-collection`.
$page_size = 56; // int | The maximum number of redirects to return. The service may return fewer than this value.  If unspecified, at most 50 redirects are returned.  The maximum value is 1000; values above 1000 are coerced to 1000.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListRedirects](/api#operation/ListRedirects) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListRedirects](/api#operation/ListRedirects) must match the call that provided the page token.

try {
  $result = $apiInstance->listRedirects(
    $collection_id,
    $page_size,
    $page_token
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling RedirectsApi->listRedirects: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                | Notes      |
| ----------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ---------- |
| **collection_id** | **string** | The collection that owns this set of redirects, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                            |
| **page_size**     | **int**    | The maximum number of redirects to return. The service may return fewer than this value. If unspecified, at most 50 redirects are returned. The maximum value is 1000; values above 1000 are coerced to 1000.                                                                              | [optional] |
| **page_token**    | **string** | A page token, received from a previous [ListRedirects](/api#operation/ListRedirects) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListRedirects](/api#operation/ListRedirects) must match the call that provided the page token. | [optional] |

### Return type

[**\Sajari\Model\ListRedirectsResponse**](../Model/ListRedirectsResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateRedirect()`

```php
updateRedirect($collection_id, $redirect_id, $update_mask, $redirect): \Sajari\Model\Redirect
```

Update redirect

Update the details of a redirect. Pass each field that you want to update in the request body. Also specify the name of each field that you want to update in the `update_mask` in the request URL query string. Separate multiple fields with a comma. Fields included in the request body, but not included in the field mask are not updated. For example, to update the `condition` field, make a `PATCH` request to the URL: `/v4/collections/{collection_id}/redirects/{redirect_id}?update_mask=condition` With the JSON body: `{ \"condition\": \"new value\", \"target\": \"...\" }` > Note: In this example `target` is not updated because it is not specified in the `update_mask`.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\RedirectsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection the redirect belongs to, e.g. `my-collection`.
$redirect_id = "redirect_id_example"; // string | The redirect to update, e.g. `1234`.
$update_mask = "update_mask_example"; // string | The list of fields to be updated, separated by a comma, e.g. `field1,field2`.  Each field should be in snake case, e.g. `condition`, `target`.  For each field that you want to update, provide a corresponding value in the redirect object containing the new value.
$redirect = new \Sajari\Model\Redirect(); // \Sajari\Model\Redirect | Details of the redirect to update.

try {
  $result = $apiInstance->updateRedirect(
    $collection_id,
    $redirect_id,
    $update_mask,
    $redirect
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling RedirectsApi->updateRedirect: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                               | Description                                                                                                                                                                                                                                                                                        | Notes |
| ----------------- | -------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----- |
| **collection_id** | **string**                                         | The collection the redirect belongs to, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                            |
| **redirect_id**   | **string**                                         | The redirect to update, e.g. &#x60;1234&#x60;.                                                                                                                                                                                                                                                     |
| **update_mask**   | **string**                                         | The list of fields to be updated, separated by a comma, e.g. &#x60;field1,field2&#x60;. Each field should be in snake case, e.g. &#x60;condition&#x60;, &#x60;target&#x60;. For each field that you want to update, provide a corresponding value in the redirect object containing the new value. |
| **redirect**      | [**\Sajari\Model\Redirect**](../Model/Redirect.md) | Details of the redirect to update.                                                                                                                                                                                                                                                                 |

### Return type

[**\Sajari\Model\Redirect**](../Model/Redirect.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
