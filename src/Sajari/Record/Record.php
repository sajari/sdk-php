<?php

namespace Sajari\Record;

class Record
{
    /** @var Meta[] $meta */
    private $meta;

    /**
     * Document constructor.
     * @param $meta
     */
    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return Meta[]
     */
    public function getMeta()
    {
        return $this->meta;
    }


}
