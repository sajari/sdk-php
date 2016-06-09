<?php

namespace Sajari\Search;

/**
 * @param Filter[] $filters
 * @return CombinatorFilter
 */
function All($filters)
{
    return new CombinatorFilter(CombinatorFilter::ALL, $filters);
}

/**
 * @param Filter[] $filters
 * @return CombinatorFilter
 */
function Any($filters)
{
    return new CombinatorFilter(CombinatorFilter::ANY, $filters);
}

/**
 * @param Filter[] $filters
 * @return CombinatorFilter
 */
function One($filters)
{
    return new CombinatorFilter(CombinatorFilter::ONE, $filters);
}

/**
 * @param Filter[] $filters
 * @return CombinatorFilter
 */
function None($filters)
{
    return new CombinatorFilter(CombinatorFilter::NONE, $filters);
}

class CombinatorFilter extends Filter
{
    const ALL = 0;
    const ANY = 1;
    const ONE = 2;
    const NONE = 3;
    /** @var int $operator */
    private $operator;
    /** @var Filter[] $filters */
    private $filters;

    /**
     * CombinatorFilter constructor.
     * @param int $operator
     * @param Filter[] $filters
     */
    public function __construct($operator, array $filters)
    {
        $this->operator = $operator;
        $this->filters = $filters;
    }

    /**
     * @return int
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return Filter[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    public function Proto()
    {
        $fc = new engine\query\Filter\Combinator();
        $fc->setOperator($this->operator);

        foreach ($this->filters as $filter) {
            $fc->addFilters($filter->Proto());
        }

        $f = new engine\query\Filter();
        $f->setCombinator($fc);

        return $f;
    }
}