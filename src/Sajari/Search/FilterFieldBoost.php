<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\FieldBoost\Filter as ProtoFilter;
use sajari\engine\query\v1\FieldBoost as ProtoFieldBoost;

class FilterFieldBoost extends FieldBoost
{
    /** @var Filter $filter */
    private $filter;
    /** @var float $value */
    private $value;

    /**
     * FilterMetaBoost constructor.
     * @param Filter $filter
     * @param float $value
     */
    public function __construct(Filter $filter, $value)
    {
        $this->filter = $filter;
        $this->value = $value;
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return engine\query\FieldBoost
     */
    public function Proto()
    {
        $fmb = new ProtoFilter();
        $fmb->setFilter($this->filter->Proto());
        $fmb->setValue($this->value);

        $mb = new ProtoFieldBoost();
        $mb->setFilter($fmb);
        return $mb;
    }
}
