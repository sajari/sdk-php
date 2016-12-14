<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\SearchRequest\FeatureQuery\FieldBoost as EngineFieldBoost;

use Sajari\Search\FieldBoost;

class FeatureFieldBoost
{
    /**
     * @var FieldBoost $fieldBoost
     */
    private $fieldBoost;

    /**
     * @var float $value
     */
    private $value;

    /**
     * @return FeatureFieldBoost
     */
    public function __construct($fieldBoost, $value)
    {
        $this->fieldBoost = $fieldBoost;
        $this->value = $value;
    }

    /**
     * @return EngineFieldBoost
     */
    public function Proto()
    {
        $fb = new EngineFieldBoost();

        $fb->setFieldBoost($this->fieldBoost->Proto());
        $fb->setValue($this->value);

        return $fb;
    }
}
