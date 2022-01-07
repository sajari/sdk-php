# Sajari\PromotionsApi

All URIs are relative to https://api.search.io.

| Method                                                    | HTTP request                                                         | Description      |
| --------------------------------------------------------- | -------------------------------------------------------------------- | ---------------- |
| [**createPromotion()**](PromotionsApi.md#createPromotion) | **POST** /v4/collections/{collection_id}/promotions                  | Create promotion |
| [**deletePromotion()**](PromotionsApi.md#deletePromotion) | **DELETE** /v4/collections/{collection_id}/promotions/{promotion_id} | Delete promotion |
| [**getPromotion()**](PromotionsApi.md#getPromotion)       | **GET** /v4/collections/{collection_id}/promotions/{promotion_id}    | Get promotion    |
| [**listPromotions()**](PromotionsApi.md#listPromotions)   | **GET** /v4/collections/{collection_id}/promotions                   | List promotions  |
| [**updatePromotion()**](PromotionsApi.md#updatePromotion) | **PATCH** /v4/collections/{collection_id}/promotions/{promotion_id}  | Update promotion |

## `createPromotion()`

```php
createPromotion($collection_id, $promotion): \Sajari\Model\Promotion
```

Create promotion

Create a new promotion in a collection.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PromotionsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection to create a promotion in, e.g. `my-collection`.
$promotion = new \Sajari\Model\Promotion(); // \Sajari\Model\Promotion | The promotion to create.

try {
  $result = $apiInstance->createPromotion($collection_id, $promotion);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PromotionsApi->createPromotion: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                                 | Description                                                              | Notes |
| ----------------- | ---------------------------------------------------- | ------------------------------------------------------------------------ | ----- |
| **collection_id** | **string**                                           | The collection to create a promotion in, e.g. &#x60;my-collection&#x60;. |
| **promotion**     | [**\Sajari\Model\Promotion**](../Model/Promotion.md) | The promotion to create.                                                 |

### Return type

[**\Sajari\Model\Promotion**](../Model/Promotion.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePromotion()`

```php
deletePromotion($collection_id, $promotion_id): mixed
```

Delete promotion

Delete a promotion and all of its associated data. > Note: This operation cannot be reversed.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PromotionsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection the promotion belongs to, e.g. `my-collection`.
$promotion_id = "promotion_id_example"; // string | The promotion to delete, e.g. `1234`.

try {
  $result = $apiInstance->deletePromotion($collection_id, $promotion_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PromotionsApi->deletePromotion: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                              | Notes |
| ----------------- | ---------- | ------------------------------------------------------------------------ | ----- |
| **collection_id** | **string** | The collection the promotion belongs to, e.g. &#x60;my-collection&#x60;. |
| **promotion_id**  | **string** | The promotion to delete, e.g. &#x60;1234&#x60;.                          |

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

## `getPromotion()`

```php
getPromotion($collection_id, $promotion_id): \Sajari\Model\Promotion
```

Get promotion

Retrieve the details of a promotion.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PromotionsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns the promotion, e.g. `my-collection`.
$promotion_id = "promotion_id_example"; // string | The promotion to retrieve, e.g. `1234`.

try {
  $result = $apiInstance->getPromotion($collection_id, $promotion_id);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PromotionsApi->getPromotion: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                             | Notes |
| ----------------- | ---------- | ----------------------------------------------------------------------- | ----- |
| **collection_id** | **string** | The collection that owns the promotion, e.g. &#x60;my-collection&#x60;. |
| **promotion_id**  | **string** | The promotion to retrieve, e.g. &#x60;1234&#x60;.                       |

### Return type

[**\Sajari\Model\Promotion**](../Model/Promotion.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listPromotions()`

```php
listPromotions($collection_id, $page_size, $page_token): \Sajari\Model\ListPromotionsResponse
```

List promotions

Retrieve a list of promotions in a collection. Promotion pins, exclusions and filter boosts are not returned in this call.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PromotionsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection that owns this set of promotions, e.g. `my-collection`.
$page_size = 56; // int | The maximum number of promotions to return. The service may return fewer than this value.  If unspecified, at most 50 promotions are returned.  The maximum value is 1000; values above 1000 are coerced to 1000.
$page_token = "page_token_example"; // string | A page token, received from a previous [ListPromotions](/api#operation/ListPromotions) call.  Provide this to retrieve the subsequent page.  When paginating, all other parameters provided to [ListPromotions](/api#operation/ListPromotions) must match the call that provided the page token.

try {
  $result = $apiInstance->listPromotions(
    $collection_id,
    $page_size,
    $page_token
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PromotionsApi->listPromotions: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type       | Description                                                                                                                                                                                                                                                                                    | Notes      |
| ----------------- | ---------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **collection_id** | **string** | The collection that owns this set of promotions, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                               |
| **page_size**     | **int**    | The maximum number of promotions to return. The service may return fewer than this value. If unspecified, at most 50 promotions are returned. The maximum value is 1000; values above 1000 are coerced to 1000.                                                                                | [optional] |
| **page_token**    | **string** | A page token, received from a previous [ListPromotions](/api#operation/ListPromotions) call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to [ListPromotions](/api#operation/ListPromotions) must match the call that provided the page token. | [optional] |

### Return type

[**\Sajari\Model\ListPromotionsResponse**](../Model/ListPromotionsResponse.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePromotion()`

```php
updatePromotion($collection_id, $promotion_id, $update_mask, $promotion): \Sajari\Model\Promotion
```

Update promotion

Update the details of a promotion. Pass each field that you want to update in the request body. Also specify the name of each field that you want to update in the `update_mask` in the request URL query string. Separate multiple fields with a comma. Fields included in the request body, but not included in the field mask are not updated. For example, to update the `display_name` and `start_time` fields, make a `PATCH` request to the URL: `/v4/collections/{collection_id}/promotions/{promotion_id}?update_mask=display_name,start_time` With the JSON body: `{ \"display_name\": \"new value\", \"start_time\": \"2006-01-02T15:04:05Z07:00\", \"end_time\": \"2006-01-02T15:04:05Z07:00\" }` > Note: In this example `end_time` is not updated because it is not specified in the `update_mask`.

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\PromotionsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$collection_id = "collection_id_example"; // string | The collection the promotion belongs to, e.g. `my-collection`.
$promotion_id = "promotion_id_example"; // string | The promotion to update, e.g. `1234`.
$update_mask = "update_mask_example"; // string | The list of fields to be updated, separated by a comma, e.g. `field1,field2`.  Each field should be in snake case, e.g. `display_name`, `filter_boosts`.  For each field that you want to update, provide a corresponding value in the promotion object containing the new value.
$promotion = new \Sajari\Model\Promotion(); // \Sajari\Model\Promotion | Details of the promotion to update.

try {
  $result = $apiInstance->updatePromotion(
    $collection_id,
    $promotion_id,
    $update_mask,
    $promotion
  );
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling PromotionsApi->updatePromotion: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name              | Type                                                 | Description                                                                                                                                                                                                                                                                                                   | Notes |
| ----------------- | ---------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----- |
| **collection_id** | **string**                                           | The collection the promotion belongs to, e.g. &#x60;my-collection&#x60;.                                                                                                                                                                                                                                      |
| **promotion_id**  | **string**                                           | The promotion to update, e.g. &#x60;1234&#x60;.                                                                                                                                                                                                                                                               |
| **update_mask**   | **string**                                           | The list of fields to be updated, separated by a comma, e.g. &#x60;field1,field2&#x60;. Each field should be in snake case, e.g. &#x60;display_name&#x60;, &#x60;filter_boosts&#x60;. For each field that you want to update, provide a corresponding value in the promotion object containing the new value. |
| **promotion**     | [**\Sajari\Model\Promotion**](../Model/Promotion.md) | Details of the promotion to update.                                                                                                                                                                                                                                                                           |

### Return type

[**\Sajari\Model\Promotion**](../Model/Promotion.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
