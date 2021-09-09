# # SendEventRequest

## Properties

| Name         | Type                   | Description                                                                                                                                                                                                                                                                   | Notes      |
| ------------ | ---------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **name**     | **string**             | The name of event, e.g. &#x60;click&#x60;, &#x60;purchase&#x60;.                                                                                                                                                                                                              |
| **token**    | **string**             | The token corresponding to the search result that was interacted with, e.g. &#x60;eyJ...&#x60;.                                                                                                                                                                               |
| **weight**   | **int**                | The weight assigned to the event. Generally a sensible weight is 1. If you want to weight an event in a certain way you can use a value other than 1. For example, if you want to capture profit in an event, you could set the weight to a value that represents the profit. | [optional] |
| **metadata** | **map[string,object]** | An object made up of field-value pairs that contains additional metadata to record with the event. Every value in the object must be one of the following primitive types: - boolean - number - string                                                                        | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
