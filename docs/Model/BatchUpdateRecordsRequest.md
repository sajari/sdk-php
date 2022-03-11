# # BatchUpdateRecordsRequest

## Properties

| Name            | Type                                                              | Description                                                                                                                                                                                                                                                                                                                            | Notes      |
| --------------- | ----------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- |
| **requests**    | [**\Sajari\Model\UpdateRecordRequest[]**](UpdateRecordRequest.md) | The list of requests containing the records to be updated. A maximum of 200 records can be updated in a batch.                                                                                                                                                                                                                         |
| **update_mask** | **string**                                                        | The list of fields to be updated, separated by a comma, e.g. &#x60;field1,field2&#x60;. For each field that you want to update, provide a corresponding value in each record object, within the requests list, containing the new value. If provided, and you also provide an update mask in any child request, the values must match. | [optional] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
