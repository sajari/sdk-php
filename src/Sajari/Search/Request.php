<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

// use sajari\engine\query\
use sajari\engine\query\SearchRequest as ProtoSearchRequest;

class Request
{
    /** @var string $body */
    private $body;
    /** @var int $resultsPerPage */
    private $resultsPerPage;
    /** @var Filter $filter */
    private $filter;
    /** @var int $page */
    private $page;
    /** @var WeightedBody $weightedBody */
    private $weightedBody;
    /** @var string[] $fields */
    private $fields;
    /** @var InstanceBoost[] $instanceBoosts */
    private $instanceBoosts;
    /** @var Aggregate[] $aggregates */
    private $aggregates;
    /** @var Sort[] $sorts */
    private $sorts;
    /** @var FieldBoost[] $fieldBoosts */
    private $fieldBoosts;

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
    public function setFieldBoosts($fieldBoosts)
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
    public function setInstanceBoosts($instanceBoosts)
    {
        $this->instanceBoosts = $instanceBoosts;
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
     * @param integer $resultsPerPage
     */
    public function setResultsPerPage($resultsPerPage)
    {
        $this->resultsPerPage = $resultsPerPage;
    }

    /**
     * @return ProtoSearchRequest
     * @throws Exception
     */
    public function Proto()
    {
        $r = new ProtoSearchRequest();

        // Page
        if (isset($this->page)) {
            $r->setPage($this->page);
        }

        // Body
        if (isset($this->body)) {
            $r->setBody($this->body->Proto());
        }

        // Max Results
        if (isset($this->resultsPerPage)) {
            $r->setResultsPerPage($this->resultsPerPage);
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

        // Instance Boosts
        if (isset($this->instanceBoosts)) {
            foreach ($this->instanceBoosts as $ib) {
                $r->addInstanceBoosts($ib->Proto());
            }
        }

        // Field Boosts
        if (isset($this->fieldBoosts)) {
            foreach ($this->fieldBoosts as $mb) {
                $r->addFieldBoosts($mb->Proto());
            }
        }

        return $r;
    }
}
