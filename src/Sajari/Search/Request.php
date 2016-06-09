<?php

namespace Sajari\Search;

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