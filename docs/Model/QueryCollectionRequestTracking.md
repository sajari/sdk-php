# # QueryCollectionRequestTracking

## Properties

| Name         | Type                                                                                          | Description                                                                                 | Notes      |
| ------------ | --------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ---------- |
| **data**     | **map[string,string]**                                                                        | A set of custom values to be included in tracking data.                                     | [optional] |
| **field**    | **string**                                                                                    | The tracking field used to identify records in the collection. Must be unique schema field. | [optional] |
| **query_id** | **string**                                                                                    | The query ID of the query. If this is empty, then one is generated.                         | [optional] |
| **sequence** | **int**                                                                                       | The sequence number of query.                                                               | [optional] |
| **type**     | [**\Sajari\Model\QueryCollectionRequestTrackingType**](QueryCollectionRequestTrackingType.md) |                                                                                             | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
