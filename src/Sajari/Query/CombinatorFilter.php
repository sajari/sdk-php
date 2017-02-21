<?php

namespace Sajari\Query;

function _require_all($dir, $depth=0) {
        // require all php files
        $scan = glob("$dir/*");
        foreach ($scan as $path) {
            if (preg_match('/\.php$/', $path)) {
                require_once $path;
            }
            elseif (is_dir($path)) {
                _require_all($path, $depth+1);
            }
        }
    }

_require_all(__DIR__.'/../proto', 10);

/**
 * Class CombinatorFilter
 * @package Sajari\Query
 */
class CombinatorFilter implements Filter, \Sajari\Misc\Proto
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
        return new CombinatorFilter(\sajariGen\engine\query\v1\Filter\Combinator\Operator::ANY, $filters);
    }

    /**
     * @param Filter[] $filters
     * @return CombinatorFilter
     */
    public static function One($filters)
    {
        return new CombinatorFilter(\sajariGen\engine\query\v1\Filter\Combinator\Operator::ONE, $filters);
    }

    /**
     * @param Filter[] $filters
     * @return CombinatorFilter
     */
    public static function None($filters)
    {
        return new CombinatorFilter(\sajariGen\engine\query\v1\Filter\Combinator\Operator::NONE, $filters);
    }

    /**
     * @return \sajariGen\engine\query\v1\Filter
     */
    public function Proto()
    {
        $fc = new \sajariGen\engine\query\v1\Filter\Combinator();
        $fc->setOperator($this->operator);

        foreach ($this->filters as $filter) {
            $fc->addFilters($filter->Proto());
        }

        $f = new \sajariGen\engine\query\v1\Filter();
        $f->setCombinator($fc);

        return $f;
    }
}
