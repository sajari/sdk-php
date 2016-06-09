<?php

namespace Sajari\Document;

class Document
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

