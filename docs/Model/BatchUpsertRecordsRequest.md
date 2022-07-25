# # BatchUpsertRecordsRequest

## Properties

| Name          | Type                                                                                                            | Description                                                                                        | Notes      |
| ------------- | --------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- | ---------- |
| **pipeline**  | [**\Sajari\Model\BatchUpsertRecordsRequestPipeline**](BatchUpsertRecordsRequestPipeline.md)                     |                                                                                                    | [optional] |
| **records**   | **object[]**                                                                                                    | A list of records to upsert. A maximum of 200 records can be upserted in a batch.                  |
| **variables** | [**map[string,AnyOfNullBooleanIntegerLongFloatDoubleString]**](AnyOfNullBooleanIntegerLongFloatDoubleString.md) | The initial values for the variables the pipeline operates on and transforms throughout its steps. | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
