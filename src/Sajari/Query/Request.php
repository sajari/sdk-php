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

    /**
     * Request constructor.
     * @param string $text
     * @param int $limit
     */
    public function __construct($text = "", $limit = 10)
    {
        if ($text !== "") {
            $this->body = [new Body($text)];
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
     * @param Tracking $tracking
     */
    public function setTracking($tracking)
    {
        $this->tracking = $tracking;
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
     * @return IndexQuery
     */
    public function getIndexQuery()
    {
        return $this->indexQuery;
    }

    /**
     * @param IndexQuery $indexQuery
     */
    public function setIndexQuery($indexQuery)
    {
        $this->indexQuery = $indexQuery;
    }

    /**
     * @return FeatureQuery
     */
    public function getFeatureQuery()
    {
        return $this->featureQuery;
    }

    /**
     * @param FeatureQuery $featureQuery
     */
    public function setFeatureQuery($featureQuery)
    {
        $this->featureQuery = $featureQuery;
    }

    /**
     * @return integer
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param integer $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param integer $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
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
    public function setSorts(array $sorts)
    {
        $this->sorts = $sorts;
    }

    /**
     * @return FieldBoost[]
     */
    public function getFieldBoosts()
    {
        return $this->fieldBoosts;
    }

    /**
     * @param FieldBoost[] $fieldBoosts
     */
    public function setFieldBoosts(array $fieldBoosts)
    {
        $this->fieldBoosts = $fieldBoosts;
    }

    /**
     * @return InstanceBoost[]
     */
    public function getInstanceBoosts()
    {
        return $this->instanceBoosts;
    }

    /**
     * @param InstanceBoost[] $instanceBoosts
     */
    public function setInstanceBoosts(array $instanceBoosts)
    {
        $this->instanceBoosts = $instanceBoosts;
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
    public function setFields(array $fields)
    {
        $this->fields = $fields;
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
    public function setAggregates(array $aggregates)
    {
        $this->aggregates = $aggregates;
    }

    /**
     * @return Transform[]
     */
    public function getTransforms()
    {
        return $this->transforms;
    }

    /**
     * @param Transform[] $transforms
     */
    public function setTransforms(array $transforms)
    {
        $this->transforms = $transforms;
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
        $r->setTracking(isset($this->tracking) ? $this->tracking->Proto() : new \Sajari\Query\Tracking());

        // Transforms
        if (isset($this->transforms)) {
            foreach ($this->transforms as $t) {
                $r->addTransforms($t->Proto());
            }
        }

        return $r;
    }
}
