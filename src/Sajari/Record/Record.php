<?php

namespace Sajari\Record;

class Record
{
    /** @var Value[] $value */
    private $values;

    /**
     * Document constructor.
     * @param $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return Value[]
     */
    public function getValues()
    {
        return $this->values;
    }


}