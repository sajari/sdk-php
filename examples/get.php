<?php

require  __DIR__ . '/vendor/autoload.php';

$project = getenv("SJ_PROJECT");
$collection = getenv("SJ_COLLECTION");
$key_id = getenv("SJ_KEY_ID");
$key_secret = getenv("SJ_KEY_SECRET");

$opts = [new \Sajari\Client\WithAuth($key_id, $key_secret)];

$c = \Sajari\Client\Client::NewClient($project, $collection, $opts);

$k = new \Sajari\Record\Key("_id", "<value>");

try {
    list($res, $status) = $c->Get($k);
} catch (\Sajari\Error\RecordNotFoundException $e) {
    printf("%s found for %s\n", $e->getMessage(), $k);
    exit(1);
} catch (\Sajari\Error\Base $e) {
    printf("%s\n", $e->getMessage());
    exit(1);
} catch (\Exception $e) {
    printf("%s\n", $e->getMessage());
    exit(1);
}

function cmp(\Sajari\Record\Value $a, \Sajari\Record\Value $b) {
    if ($a->getKey() == $b->getKey()) {
        return 0;
    }
    return ($a->getKey() < $b->getKey()) ? -1 : 1;
}

$values = $res->getValues();

// Sort results before printing
uasort($values, 'cmp');

/** @var \Sajari\Record\Value $v */
foreach (values as $v) {
    printf("  %s:\n    %s\n", $v->getKey(), $v->getValue());
}
