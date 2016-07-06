<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\MetaBoost\Filter as ProtoFilter;
use sajari\engine\query\MetaBoost as ProtoMetaBoost;

class FilterMetaBoost extends MetaBoost
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
     * @return engine\query\MetaBoost
     */
    public function Proto()
    {
        $fmb = new ProtoFilter();
        $fmb->setFilter($this->filter->Proto());
        $fmb->setValue($this->value);

        $mb = new ProtoMetaBoost();
        $mb->setFilter($fmb);
        return $mb;
    }
}
