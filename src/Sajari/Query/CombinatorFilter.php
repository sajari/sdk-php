<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class CombinatorFilter
 * @package Sajari\Query
 */
class CombinatorFilter implements Filter, \Sajari\Internal\Proto
{

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

    /**
     * @param Filter[] $filters
     * @return CombinatorFilter
     */
    public static function All($filters)
    {
        return new CombinatorFilter(\Sajari\Engine\Query\V1\Filter_Combinator_Operator::ALL, $filters);
    }

    /**
     * @param Filter[] $filters
     * @return CombinatorFilter
     */
    public static function Any($filters)
    {
        return new CombinatorFilter(\Sajari\Engine\Query\V1\Filter_Combinator_Operator::ANY, $filters);
    }

    /**
     * @param Filter[] $filters
     * @return CombinatorFilter
     */
    public static function One($filters)
    {
        return new CombinatorFilter(\Sajari\Engine\Query\V1\Filter_Combinator_Operator::ONE, $filters);
    }

    /**
     * @param Filter[] $filters
     * @return CombinatorFilter
     */
    public static function None($filters)
    {
        return new CombinatorFilter(\Sajari\Engine\Query\V1\Filter_Combinator_Operator::NONE, $filters);
    }

    /**
     * @return \Sajari\Engine\Query\V1\Filter
     */
    public function proto()
    {
        $fc = new \Sajari\Engine\Query\V1\Filter_Combinator();
        $fc->setOperator($this->operator);

        foreach ($this->filters as $filter) {
            $fc->getFilters()[] = $filter->proto();
        }

        $f = new \Sajari\Engine\Query\V1\Filter();
        $f->setCombinator($fc);

        return $f;
    }
}
