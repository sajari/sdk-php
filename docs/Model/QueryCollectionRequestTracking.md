# # QueryCollectionRequestTracking

## Properties

| Name         | Type                                                                                          | Description                                                                             | Notes      |
| ------------ | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- | ---------- |
| **type**     | [**\Sajari\Model\QueryCollectionRequestTrackingType**](QueryCollectionRequestTrackingType.md) |                                                                                         | [optional] |
| **query_id** | **string**                                                                                    | Query ID of the query. If this is empty, then one is generated.                         | [optional] |
| **sequence** | **int**                                                                                       | Sequence number of query.                                                               | [optional] |
| **field**    | **string**                                                                                    | Tracking field used to identify records in the collection. Must be unique schema field. | [optional] |
| **data**     | **map[string,string]**                                                                        | Custom values to be included in tracking data.                                          | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
