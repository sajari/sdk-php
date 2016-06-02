<?php

namespace Sajari;


use DrSlump\Protobuf\Exception;

class Request
{
    /** @var string $body */
    private $body;
    /** @var int $maxResults */
    private $maxResults;
    /** @var Filter $filter */
    private $filter;
    /** @var int $page */
    private $page;
    /** @var WeightedBody $weightedBody */
    private $weightedBody;
    /** @var string[] $fields */
    private $fields;
    /** @var IndexBoost[] $indexBoosts */
    private $indexBoosts;
    /** @var Aggregate[] $aggregates */
    private $aggregates;
    /** @var Sort[] $sorts */
    private $sorts;
    /** @var MetaBoost[] $metaBoosts */
    private $metaBoosts;

    /**
     * @return MetaBoost[]
     */
    public function getMetaBoosts()
    {
        return $this->metaBoosts;
    }

    /**
     * @param MetaBoost[] $metaBoosts
     */
    public function setMetaBoosts($metaBoosts)
    {
        $this->metaBoosts = $metaBoosts;
    }

    /**
     * @return IndexBoost[]
     */
    public function getIndexBoosts()
    {
        return $this->indexBoosts;
    }

    /**
     * @param IndexBoost[] $indexBoosts
     */
    public function setIndexBoosts($indexBoosts)
    {
        $this->indexBoosts = $indexBoosts;
    }

    /**
     * @return Aggregate[]
     */
    public function getAggregates()
    {
        return $this->aggregates;
    }

    /**
     * @param Aggregate[] $aggregates
     */
    public function setAggregates($aggregates)
    {
        $this->aggregates = $aggregates;
    }

    /**
     * @return Sort[]
     */
    public function getSorts()
    {
        return $this->sorts;
    }

    /**
     * @param Sort[] $sorts
     */
    public function setSorts($sorts)
    {
        $this->sorts = $sorts;
    }

    /**
     * @return WeightedBody
     */
    public function getWeightedBody()
    {
        return $this->weightedBody;
    }

    /**
     * @param WeightedBody $weightedBody
     */
    public function setWeightedBody($weightedBody)
    {
        $this->weightedBody = $weightedBody;
    }

    /**
     * @return \string[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param \string[] $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param Filter $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return integer
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @param integer $maxResults
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
    }

    /**
     * @return engine\query\Request
     * @throws Exception
     */
    public function Proto()
    {
        $r = new engine\query\Request();

        // Page
        if (isset($this->page)) {
            $r->setPage($this->page);
        }

        // Body
        if (isset($this->body)) {
            $r->setBody($this->body);
        }

        // Max Results
        if (isset($this->maxResults)) {
            $r->setMaxResults($this->maxResults);
        }

        // Filter
        if (isset($this->filter)) {
            $r->setFilter($this->filter->Proto());
        }

        // Fields
        if (isset($this->fields)) {
            foreach ($this->fields as $field) {
                $r->addFields($field);
            }
        }

        // Weighted Body
        if (isset($this->weightedBody)) {
            $r->setWeightedBody($this->weightedBody->Proto());
        }

        // Sorts
        if (isset($this->sorts)) {
            foreach ($this->sorts as $s) {
                $r->addSort($s->Proto());
            }
        }

        // Aggregates
        if (isset($this->aggregates)) {
            foreach ($this->aggregates as $agg) {
                $r->addAggregates($agg->Proto());
            }
        }

        // Index Boosts
        if (isset($this->indexBoosts)) {
            foreach ($this->indexBoosts as $ib) {
                $r->addIndexBoosts($ib->Proto());
            }
        }

        // Meta Boosts
        if (isset($this->metaBoosts)) {
            foreach ($this->metaBoosts as $mb) {
                $r->addMetaBoosts($mb->Proto());
            }
        }

        return $r;
    }
}

class Response
{
    /** @var integer $totalResults */
    private $totalResults;
    /** @var integer $reads */
    private $reads;
    /** @var string $time */
    private $time;
    /** @var Result[] $results */
    private $results;
    /** @var ResultAggregate[] $aggregates */
    private $aggregates;

    /**
     * Response constructor.
     * @param int $totalResults
     * @param int $reads
     * @param string $time
     * @param Result[] $results
     * @param ResultAggregate[] $aggregates
     */
    public function __construct($totalResults, $reads, $time, array $results, array $aggregates)
    {
        $this->totalResults = $totalResults;
        $this->reads = $reads;
        $this->time = $time;
        $this->results = $results;
        $this->aggregates = $aggregates;
    }

    /**
     * @return int
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * @return int
     */
    public function getReads()
    {
        return $this->reads;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return Result[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return ResultAggregate[]
     */
    public function getAggregates()
    {
        return $this->aggregates;
    }

}

class BucketResponseAggregate
{
    /** @var string $name */
    private $name;
    /** @var int $count */
    private $count;

    /**
     * BucketResponseAggregate constructor.
     * @param string $name
     * @param int $count
     */
    public function __construct($name, $count)
    {
        $this->name = $name;
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}

class CountResponseAggregate
{
    /** @var string $name */
    private $name;
    /** @var int $count */
    private $count;

    /**
     * CountResponseAggregate constructor.
     * @param string $name
     * @param int $count
     */
    public function __construct($name, $count)
    {
        $this->name = $name;
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}

class MetricResponseAggregate
{
    /** @var float $value */
    private $value;

    /**
     * MetricResponseAggregate constructor.
     * @param float $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}

class ResultAggregate
{
    private $key;
    private $value;

    /**
     * Aggregate constructor.
     * @param $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}

abstract class Aggregate
{
    abstract public function Proto();
}

function AvgMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::AVG, $name);
}

function MinMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::MIN, $name);
}

function MaxMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::MAX, $name);
}

function SumMetricAggregate($field, $name)
{
    return new MetricAggregate($field, MetricAggregate::SUM, $name);
}

class MetricAggregate extends Aggregate
{
    const AVG = 0;
    const MIN = 1;
    const MAX = 2;
    const SUM = 3;
    /** @var string $field */
    private $field;
    /** @var int $type */
    private $type;
    /** @var string $name */
    private $name;

    /**
     * MetricAggregate constructor.
     * @param string $field
     * @param int $type
     * @param string $name
     */
    public function __construct($field, $type, $name)
    {
        $this->field = $field;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    public function Proto()
    {
        $ae = new engine\query\Request\AggregatesEntry();
        $ae->setKey($this->name);

        $ma = new engine\query\Aggregate\Metric();
        $ma->setField($this->field);
        $ma->setType($this->type);

        $a = new engine\query\Aggregate();
        $a->setMetric($ma);

        $ae->setValue($a);
        return $ae;
    }
}

/**
 * @param string $field
 * @return CountAggregate
 */
function Count($field, $name)
{
    return new CountAggregate($field, $name);
}

class CountAggregate extends Aggregate
{
    /** @var string $field */
    private $field;
    /** @var string $name */
    private $name;

    /**
     * CountAggregate constructor.
     * @param string $field
     * @param $name
     */
    public function __construct($field, $name)
    {
        $this->field = $field;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    public function Proto()
    {
        $ca = new engine\query\Aggregate\Count();
        $ca->setField($this->field);

        $a = new engine\query\Aggregate();
        $a->setCount($ca);

        $ae = new engine\query\Request\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}


/**
 * @param string $name
 * @param Filter $filter
 * @return BucketAggregateEntry
 */
function BucketEntry($name, $filter)
{
    return new BucketAggregateEntry($name, $filter);
}

class BucketAggregateEntry
{
    /** @var string $name */
    private $name;
    /** @var Filter $filter */
    private $filter;

    public function __construct($name, Filter $filter)
    {
        $this->name = $name;
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    public function Proto()
    {
        $be = new engine\query\Aggregate\Bucket\Bucket();
        $be->setName($this->name);
        $be->setFilter($this->filter->Proto());
        return $be;
    }
}

/**
 * @param string $name
 * @param BucketAggregateEntry[] $buckets
 * @return BucketAggregate
 */
function Bucket($name, $buckets)
{
    return new BucketAggregate($name, $buckets);
}

class BucketAggregate extends Aggregate
{
    /** @var string name */
    private $name;
    /** @var BucketAggregateEntry[] $buckets */
    private $buckets;

    /**
     * BucketAggregate constructor.
     * @param string $name
     * @param BucketAggregateEntry[] $buckets
     */
    public function __construct($name, array $buckets)
    {
        $this->name = $name;
        $this->buckets = $buckets;
    }

    /**
     * @return BucketAggregateEntry[]
     */
    public function getBuckets()
    {
        return $this->buckets;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function Proto()
    {
        $b = new engine\query\Aggregate\Bucket();

        foreach ($this->buckets as $bucket) {
            $b->addBuckets($bucket->Proto());
        }

        $a = new engine\query\Aggregate();
        $a->setBucket($b);

        $ae = new engine\query\Request\AggregatesEntry();
        $ae->setKey($this->name);
        $ae->setValue($a);
        return $ae;
    }
}

abstract class Filter {
    abstract public function Proto();
}


/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function EqualTo($field, $value)
{
    return new FieldFilter(FieldFilter::EQUAL_TO, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function DoesNotEqual($field, $value)
{
    return new FieldFilter(FieldFilter::DOES_NOT_EQUAL, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function GreaterThan($field, $value)
{
    return new FieldFilter(FieldFilter::GREATER_THAN, $field, $value);
}
/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function GreaterThanOrEqualTo($field, $value)
{
    return new FieldFilter(FieldFilter::GREATER_THAN_OR_EQUAL_TO, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function LessThan($field, $value)
{
    return new FieldFilter(FieldFilter::LESS_THAN, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function LessThanOrEqualTo($field, $value)
{
    return new FieldFilter(FieldFilter::LESS_THAN_OR_EQUAL_TO, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function Contains($field, $value)
{
    return new FieldFilter(FieldFilter::CONTAINS, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function DoesNotContain($field, $value)
{
    return new FieldFilter(FieldFilter::DOES_NOT_CONTAIN, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function EndsWith($field, $value)
{
    return new FieldFilter(FieldFilter::ENDS_WITH, $field, $value);
}

/**
 * @param string $field
 * @param $value
 * @return FieldFilter
 */
function StartsWith($field, $value)
{
    return new FieldFilter(FieldFilter::STARTS_WITH, $field, $value);
}

class FieldFilter extends Filter
{
    const EQUAL_TO = 0;
    const DOES_NOT_EQUAL = 1;
    const GREATER_THAN = 2;
    const GREATER_THAN_OR_EQUAL_TO = 3;
    const LESS_THAN = 4;
    const LESS_THAN_OR_EQUAL_TO = 5;
    const CONTAINS = 6;
    const DOES_NOT_CONTAIN = 7;
    const ENDS_WITH = 8;
    const STARTS_WITH = 9;
    /** @var integer $operator */
    private $operator;
    /** @var string $field */
    private $field;
    private $value;

    /**
     * FieldFilter constructor.
     * @param int $operator
     * @param string $field
     * @param $value
     */
    public function __construct($operator, $field, $value)
    {
        $this->operator = $operator;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return engine\query\Filter\Field
     */
    public function Proto()
    {
        $ff = new engine\query\Filter\Field();
        $ff->setField($this->field);
        $ff->setValue($this->value);
        $ff->setOperator($this->operator);

        $f = new engine\query\Filter();
        $f->setField($ff);

        return $f;
    }
}


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

class WeightedBody
{
    /** @var string $body */
    private $body;
    /** @var float $weight */
    private $weight;

    /**
     * WeightedBody constructor.
     * @param string $body
     * @param float $weight
     */
    public function __construct($body, $weight)
    {
        $this->body = $body;
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return engine\query\WeightedBody
     */
    public function Proto()
    {
        $wb = new engine\query\WeightedBody();
        $wb->setBody($this->body);
        $wb->setWeight($this->weight);
        return $wb;
    }
}

/**
 * @param $field
 * @return Sort
 */
function Asc($field)
{
    return new Sort($field, Sort::ASC);
}

/**
 * @param $field
 * @return Sort
 */
function Desc($field)
{
    return new Sort($field, Sort::DESC);
}

class Sort
{
    const ASC = 0;
    const DESC = 1;
    /** @var string $field */
    private $field;
    /** @var int $order */
    private $order;

    /**
     * Sort constructor.
     * @param string $field
     * @param $order
     */
    public function __construct($field, $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return engine\query\Sort
     */
    public function Proto()
    {
        $s = new engine\query\Sort();
        $s->setField($this->field);
        $s->setOrder($this->order);
        return $s;
    }
}

abstract class IndexBoost
{
    abstract public function Proto();
}

function PosNegBoost($value)
{
    return new PosNegIndexBoost($value);
}

class PosNegIndexBoost extends IndexBoost
{
    /** @var float $value */
    private $value;

    /**
     * PosNegIndexBoost constructor.
     * @param float $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $pn = new engine\query\IndexBoost\PosNeg();
        $pn->setValue($this->value);

        $ib = new engine\query\IndexBoost();
        $ib->setPosNeg($pn);

        return $ib;
    }
}

function FieldBoost($field, $value)
{
    return new FieldIndexBoost($field, $value);
}

class FieldIndexBoost extends IndexBoost
{
    /** @var string $field */
    private $field;
    /** @var float $value */
    private $value;

    /**
     * FieldIndexBoost constructor.
     * @param string $field
     * @param float $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $f = new engine\query\IndexBoost\Field();
        $f->setField($this->field);
        $f->setValue($this->value);

        $ib = new engine\query\IndexBoost();
        $ib->setField($f);

        return $ib;
    }
}

abstract class MetaBoost
{
    /** @return engine\query\MetaBoost */
    abstract public function Proto();
}

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
        $fmb = new engine\query\MetaBoost\Filter();
        $fmb->setFilter($this->filter->Proto());
        $fmb->setValue($this->value);

        $mb = new engine\query\MetaBoost();
        $mb->setFilter($fmb);
        return $mb;
    }
}

class AddMetaBoost extends MetaBoost
{
    /** @var MetaBoost $metaBoost */
    private $metaBoost;
    /** @var float $value */
    private $value;

    /**
     * AddMetaBoost constructor.
     * @param MetaBoost $metaBoost
     * @param $value
     */
    public function __construct(MetaBoost $metaBoost, $value)
    {
        $this->metaBoost = $metaBoost;
        $this->value = $value;
    }

    /**
    * @return MetaBoost
    */
    public function getMetaBoost()
    {
        return $this->metaBoost;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $amb = new engine\query\MetaBoost\Add();
        $amb->setMetaBoost($this->metaBoost);
        $amb->setValue($this->value);

        $mb = new engine\query\MetaBoost();
        $mb->setAdd($amb);
        return $mb;
    }
}

/**
 * @param string $fieldLat
 * @param string $fieldLng
 * @param float $lat
 * @param float $lng
 * @param float $radius
 * @param float $value
 * @return GeoMetaBoost
 */
function BoostInsideRegion($fieldLat, $fieldLng, $lat, $lng, $radius, $value) {
    return new GeoMetaBoost($fieldLat, $fieldLng, $lat, $lng, $radius, $value, \sajari\engine\query\MetaBoost\Geo\Region::INSIDE);
}

/**
 * @param string $fieldLat
 * @param string $fieldLng
 * @param float $lat
 * @param float $lng
 * @param float $radius
 * @param float $value
 * @return GeoMetaBoost
 */
function BoostOutsideRegion($fieldLat, $fieldLng, $lat, $lng, $radius, $value) {
    return new GeoMetaBoost($fieldLat, $fieldLng, $lat, $lng, $radius, $value, \sajari\engine\query\MetaBoost\Geo\Region::OUTSIDE);
}

class GeoMetaBoost extends MetaBoost
{
    /** @var string $fieldLat */
    private $fieldLat;
    /** @var string $fieldLng */
    private $fieldLng;
    /** @var float $lat */
    private $lat;
    /** @var float $lng */
    private $lng;
    /** @var float $radius */
    private $radius;
    /** @var float $value */
    private $value;
    /** @var int $region */
    private $region;

    /**
     * GeoMetaBoost constructor.
     * @param string $fieldLat
     * @param string $fieldLng
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @param float $value
     * @param int $region
     */
    public function __construct($fieldLat, $fieldLng, $lat, $lng, $radius, $value, $region)
    {
        $this->fieldLat = $fieldLat;
        $this->fieldLng = $fieldLng;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->radius = $radius;
        $this->value = $value;
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getFieldLat()
    {
        return $this->fieldLat;
    }

    /**
     * @return string
     */
    public function getFieldLng()
    {
        return $this->fieldLng;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    public function Proto()
    {
        $gmb = new engine\query\MetaBoost\Geo();
        $gmb->setFieldLat($this->fieldLat);
        $gmb->setFieldLng($this->fieldLng);
        $gmb->setLat($this->lat);
        $gmb->setLng($this->lng);
        $gmb->setRadius($this->radius);
        $gmb->setValue($this->value);
        $gmb->setRegion($this->region);

        $mb = new engine\query\MetaBoost();
        $mb->setGeo($gmb);
        return $mb;
    }
}

class IntervalMetaBoostPoint
{
    /** @var float $point */
    private $point;
    /** @var float $value */
    private $value;

    /**
     * IntervalMetaBoostPoint constructor.
     * @param float $point
     * @param float $value
     */
    public function __construct($point, $value)
    {
        $this->point = $point;
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $p = new engine\query\MetaBoost\Interval\Point();
        $p->setPoint($this->point);
        $p->setValue($this->value);
        return $p;
    }
}

class IntervalMetaBoost extends MetaBoost
{
    /** @var string $field */
    private $field;
    /** @var IntervalMetaBoostPoint[] $point */
    private $points;

    /**
     * IntervalMetaBoost constructor.
     * @param string $field
     * @param IntervalMetaBoostPoint[] $points
     */
    public function __construct($field, array $points)
    {
        $this->field = $field;
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return IntervalMetaBoostPoint[]
     */
    public function getPoints()
    {
        return $this->points;
    }

    public function Proto()
    {
        $imb = new engine\query\MetaBoost\Interval();
        $imb->setField($this->field);
        foreach ($this->points as $point) {
            $imb->addPoints($point->Proto());
        }

        $mb = new engine\query\MetaBoost();
        $mb->setInterval($imb);
        return $mb;
    }
}

class DistanceMetaBoost
{
    /** @var float $min */
    private $min;
    /** @var $float $max */
    private $max;
    /** @var float $ref */
    private $ref;
    /** @var string $field */
    private $field;
    /** @var float $value */
    private $value;

    /**
     * DistanceMetaBoost constructor.
     * @param float $min
     * @param float $max
     * @param float $ref
     * @param string $field
     * @param float $value
     */
    public function __construct($min, $max, $ref, $field, $value)
    {
        $this->min = $min;
        $this->max = $max;
        $this->ref = $ref;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return float
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    public function Proto()
    {
        $dmb = new engine\query\MetaBoost\Distance();
        $dmb->setMin($this->min);
        $dmb->setMax($this->max);
        $dmb->setRef($this->ref);
        $dmb->setField($this->field);
        $dmb->setValue($this->value);

        $mb = new engine\query\MetaBoost();
        $mb->setDistance($dmb);
        return $mb;
    }
}

class ElementMetaBoost
{
    /** @var string $field */
    private $field;
    /** @var string[] $elements */
    private $elements;

    /**
     * ElementMetaBoost constructor.
     * @param string $field
     * @param \string[] $elements
     */
    public function __construct($field, array $elements)
    {
        $this->field = $field;
        $this->elts = $elements;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return \string[]
     */
    public function getElements()
    {
        return $this->elts;
    }

    public function Proto()
    {
        $emb = new engine\query\MetaBoost\Element();
        $emb->setField($this->field);
        foreach ($this->elements as $element) {
            $emb->addElts($element);
        }

        $mb = new engine\query\MetaBoost();
        $mb->setElement($emb);
        return $mb;
    }
}

class TextMetaBoost
{
    /** @var string $field */
    private $field;
    /** @var string $text */
    private $text;

    /**
     * TextMetaBoost constructor.
     * @param string $field
     * @param string $text
     */
    public function __construct($field, $text)
    {
        $this->field = $field;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    public function Proto()
    {
        $tmb = new engine\query\MetaBoost\Text();
        $tmb->setField($this->field);
        $tmb->setText($this->text);

        $mb = new engine\query\MetaBoost();
        $mb->setText($tmb);
        return $mb;
    }
}

class Result
{
    /** @var double $score */
    private $score;
    /** @var double $rawscore */
    private $rawscore;
    /** @var Meta[] $meta */
    private $meta;
    /**
     * Result constructor.
     * @param float $score
     * @param float $rawscore
     * @param Meta[] $meta
     */
    public function __construct($score, $rawscore, $meta)
    {
        $this->score = $score;
        $this->rawscore = $rawscore;
        $this->meta = $meta;
    }
}
