<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class FilterFieldBoost
 * @package Sajari\Query
 */
class FilterFieldBoost implements FieldBoost, Proto
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
     * @return \sajari\engine\query\v1\FieldBoost
     */
    public function Proto()
    {
        $fmb = new \sajari\engine\query\v1\FieldBoost\Filter();
        $fmb->setFilter($this->filter->Proto());
        $fmb->setValue($this->value);

        $mb = new \sajari\engine\query\v1\FieldBoost();
        $mb->setFilter($fmb);
        return $mb;
    }
}
