# # QueryCollectionResponse

## Properties

| Name                    | Type                                                                                    | Description                                                                       | Notes      |
| ----------------------- | --------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | ---------- |
| **pipeline**            | [**\Sajari\Model\QueryCollectionResponsePipeline**](QueryCollectionResponsePipeline.md) |                                                                                   | [optional] |
| **variables**           | **object**                                                                              | The modified variables returned by the pipeline after it has finished processing. | [optional] |
| **results**             | [**\Sajari\Model\QueryResult[]**](QueryResult.md)                                       | The results returned by the query.                                                | [optional] |
| **total_size**          | **string**                                                                              | The total number of results that match the query.                                 | [optional] |
| **processing_duration** | **string**                                                                              | The total time taken to perform the query.                                        | [optional] |
| **aggregates**          | [**map[string,\Sajari\Model\QueryAggregateResult]**](QueryAggregateResult.md)           | The aggregates returned by the query.                                             | [optional] |
| **aggregate_filters**   | [**map[string,\Sajari\Model\QueryAggregateResult]**](QueryAggregateResult.md)           | The aggregates run with filters.                                                  | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
