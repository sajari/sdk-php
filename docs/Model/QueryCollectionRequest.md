# # QueryCollectionRequest

## Properties

| Name          | Type                                                                                  | Description                                                                                                                                                                                                                                                                        | Notes      |
| ------------- | ------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **pipeline**  | [**\Sajari\Model\QueryCollectionRequestPipeline**](QueryCollectionRequestPipeline.md) |                                                                                                                                                                                                                                                                                    | [optional] |
| **variables** | **object**                                                                            | The initial values for the variables the pipeline operates on and transforms throughout its steps. A typical variable is &#x60;q&#x60; which is the query the user entered, for example: &#x60;&#x60;&#x60;json { \&quot;q\&quot;: \&quot;search terms\&quot; } &#x60;&#x60;&#x60; |
| **tracking**  | [**\Sajari\Model\QueryCollectionRequestTracking**](QueryCollectionRequestTracking.md) |                                                                                                                                                                                                                                                                                    | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
