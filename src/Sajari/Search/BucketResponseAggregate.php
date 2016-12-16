<?php

namespace Sajari\Search;

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
