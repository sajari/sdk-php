<?php

/**
 * Class ExampleUtils
 */
class ExampleUtils
{
    /**
     * @return \Sajari\Client\Client
     */
    public static function CreateClient()
    {
        // Get config from environment
        $project = getenv("SJ_PROJECT");
        $collection = getenv("SJ_COLLECTION");
        $key_id = getenv("SJ_KEY_ID");
        $key_secret = getenv("SJ_KEY_SECRET");

        return \Sajari\Client\Client::NewClient($project, $collection,
            [new \Sajari\Client\WithKeyCredentials($key_id, $key_secret)]
        );
    }

    /**
     * @param \Sajari\Query\Response $response
     */
    public static function PrintSearchResults(\Sajari\Query\Response $response)
    {
        printf("Query found %u results in %s.\n", $response->getTotalResults(), $response->getTime());
        foreach ($response->getResults() as $r) {
            printf("Score: %f %f\n", $r->getScore(), $r->getIndexScore());
            $values = $r->getValues();
            ksort($values);
            foreach ($values as $field => $value) {
                if (is_array($value)) {
                    printf("   %s:\n", $field);
                    foreach ($value as $i) {
                        printf("      %s\n", $i);
                    }
                } else {
                    printf("   %s: %s\n", $field, $value);
                }
            }
        }
    }

    public static function CheckStatusForErrors($status)
    {
        if ($status && $status->getCode() != 0) {
            echo $status->getMessage()."\n";
        } else {
            echo "Success\n";
        }
    }

    public static function PrintRecord(\Sajari\Record\Record $record)
    {
        function cmp($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        }

        $values = $record->getValues();
        ksort($values);

        foreach ($values as $field => $value) {
            if (is_array($value)) {
                printf("%s:\n", $field);
                foreach ($value as $i) {
                    printf("   %s\n", $i);
                }
            } else {
                printf("%s: %s\n", $field, $value);
            }
        }
    }
}