# Sajari\EventsApi

All URIs are relative to https://api-gateway.sajari.com.

| Method                                      | HTTP request                  | Description |
| ------------------------------------------- | ----------------------------- | ----------- |
| [**sendEvent()**](EventsApi.md#sendEvent)   | **POST** /v4/events:send      | Send event  |
| [**sendEvent2()**](EventsApi.md#sendEvent2) | **POST** /v4/events:sendEvent | Send event  |

## `sendEvent()`

```php
sendEvent($send_event_request): object
```

Send event

Send an event to the ranking system after a user interacts with a search result. When querying a collection, you can set the tracking type of the query request. When it is `CLICK` or `POS_NEG`, a token is generated for each result in the query response. You can use this token to provide feedback to the ranking system. Each time you want to record an event on a particular search result, use the send event call and provide: - The `name` of the event, e.g. `click`, `purchase`. - The `token` from the search result. - The `weight` to assign to the event, e.g. `1`. - An object containing any additional `metadata`. For example, to send an event where a customer purchased a product, use the following call: `json { \"name\": \"purchase\", \"token\": \"eyJ...\", \"weight\": 1, \"metadata\": { \"discount\": 0.2, \"margin\": 30.0, \"customer_id\": \"12345\", \"ui_test_segment\": \"A\" } } `

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\EventsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$send_event_request = new \Sajari\Model\SendEventRequest(); // \Sajari\Model\SendEventRequest

try {
  $result = $apiInstance->sendEvent($send_event_request);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling EventsApi->sendEvent: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                   | Type                                                               | Description | Notes |
| ---------------------- | ------------------------------------------------------------------ | ----------- | ----- |
| **send_event_request** | [**\Sajari\Model\SendEventRequest**](../Model/SendEventRequest.md) |             |

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

## `sendEvent2()`

```php
sendEvent2($send_event_request): object
```

Send event

Send an event to the ranking system after a user interacts with a search result. When querying a collection, you can set the tracking type of the query request. When it is `CLICK` or `POS_NEG`, a token is generated for each result in the query response. You can use this token to provide feedback to the ranking system. Each time you want to record an event on a particular search result, use the send event call and provide: - The `name` of the event, e.g. `click`, `purchase`. - The `token` from the search result. - The `weight` to assign to the event, e.g. `1`. - An object containing any additional `metadata`. For example, to send an event where a customer purchased a product, use the following call: `json { \"name\": \"purchase\", \"token\": \"eyJ...\", \"weight\": 1, \"metadata\": { \"discount\": 0.2, \"margin\": 30.0, \"customer_id\": \"12345\", \"ui_test_segment\": \"A\" } } `

### Example

```php
<?php
require_once __DIR__ . "/vendor/autoload.php";

// Configure HTTP basic authorization: BasicAuth
$config = Sajari\Configuration::getDefaultConfiguration()
  ->setUsername("YOUR_USERNAME")
  ->setPassword("YOUR_PASSWORD");

$apiInstance = new Sajari\Api\EventsApi(
  // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
  // This is optional, `GuzzleHttp\Client` will be used as default.
  new GuzzleHttp\Client(),
  $config
);
$send_event_request = new \Sajari\Model\SendEventRequest(); // \Sajari\Model\SendEventRequest

try {
  $result = $apiInstance->sendEvent2($send_event_request);
  print_r($result);
} catch (Exception $e) {
  echo "Exception when calling EventsApi->sendEvent2: ",
    $e->getMessage(),
    PHP_EOL;
}
```

### Parameters

| Name                   | Type                                                               | Description | Notes |
| ---------------------- | ------------------------------------------------------------------ | ----------- | ----- |
| **send_event_request** | [**\Sajari\Model\SendEventRequest**](../Model/SendEventRequest.md) |             |

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
