<?php

namespace Sajari\Query;

require_once __DIR__.'/../proto/api/query/v1/query.php';
require_once __DIR__.'/../proto/engine/query/v1/query.php';

/**
 * Class Request
 * @package Sajari\Query
 */
class Request
{
    /** @var Tracking $tracking */
    private $tracking;

    /** @var Filter $filter */
    private $filter;

    /** @var IndexQuery $indexQuery */
    private $indexQuery;

    /** @var FeatureQuery $featureQuery */
    private $featureQuery;

    /** @var integer $offset */
    private $offset;

    /** @var integer $limit */
    private $limit;

    /** @var Sort[] $sorts */
    private $sorts;

    /** @var string[] $fields */
    private $fields;

    /** @var Aggregate[] $aggregates */
    private $aggregates;

    /** @var Transform[] $transforms */
    private $transforms;

    public function __construct($body = "", $limit = 10)
    {
        if (gettype($body) === "string" && $body !== "") {
            $this->setIndexQuery(
                (new IndexQuery())->setBody([
                    new Body($body)
                ])
            );
        }
        $this->limit = $limit;
    }

    /**
     * @return Tracking
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * @param $tracking
     * @return $this
     */
    public function setTracking($tracking)
    {
        $this->tracking = $tracking;
        return $this;
    }

    /**
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param $filter
     * @return $this
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return IndexQuery
     */
    public function getIndexQuery()
    {
        return $this->indexQuery;
    }

    /**
     * @param $indexQuery
     * @return $this
     */
    public function setIndexQuery($indexQuery)
    {
        $this->indexQuery = $indexQuery;
        return $this;
    }

    /**
     * @return FeatureQuery
     */
    public function getFeatureQuery()
    {
        return $this->featureQuery;
    }

    /**
     * @param $featureQuery
     * @return $this
     */
    public function setFeatureQuery($featureQuery)
    {
        $this->featureQuery = $featureQuery;
        return $this;
    }

    /**
     * @return integer
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return Sort[]
     */
    public function getSorts()
    {
        return $this->sorts;
    }

    /**
     * @param array $sorts
     * @return $this
     */
    public function setSorts(array $sorts)
    {
        $this->sorts = $sorts;
        return $this;
    }

    /**
     * @return \string[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return Aggregate[]
     */
    public function getAggregates()
    {
        return $this->aggregates;
    }

    /**
     * @param array $aggregates
     * @return $this
     */
    public function setAggregates(array $aggregates)
    {
        $this->aggregates = $aggregates;
        return $this;
    }

    /**
     * @return Transform[]
     */
    public function getTransforms()
    {
        return $this->transforms;
    }

    /**
     * @param array $transforms
     * @return $this
     */
    public function setTransforms(array $transforms)
    {
        $this->transforms = $transforms;
        return $this;
    }

    /**
     * @return \sajariGen\api\query\v1\SearchRequest
     */
    public function ToProto()
    {
        $er = new \sajariGen\engine\query\v1\SearchRequest();

        // Offset
        if (isset($this->offset)) {
            $er->setOffset($this->offset);
        }

        // Limit
        if (isset($this->limit)) {
            $er->setLimit($this->limit);
        }

        // IndexQuery
        if (isset($this->indexQuery))
        {
            $er->setIndexQuery($this->indexQuery->Proto());
        }

        // FeatureQuery
        if (isset($this->featureQuery))
        {
            $er->setFeatureQuery($this->featureQuery->Proto());
        }

        // Filter
        if (isset($this->filter)) {
            $er->setFilter($this->filter->Proto());
        }

        // Sorts
        if (isset($this->sorts)) {
            foreach ($this->sorts as $s) {
                $er->addSort($s->Proto());
            }
        }

        // Fields
        if (isset($this->fields))
        {
            $er->setFields($this->fields);
        }

        // Aggregates
        if (isset($this->aggregates)) {
            foreach ($this->aggregates as $agg) {
                $er->addAggregates($agg->Proto());
            }
        }

        $r = new \sajariGen\api\query\v1\SearchRequest();

        $r->setSearchRequest($er);

        // Tracking
        $r->setTracking(isset($this->tracking) ? $this->tracking->Proto() : (new \Sajari\Query\Tracking())->Proto());

        // Transforms
        if (isset($this->transforms)) {
            foreach ($this->transforms as $t) {
                $r->addTransforms($t->Proto());
            }
        }

        return $r;
    }
}
