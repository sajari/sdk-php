<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class Tracking
 * @package Sajari\Query
 */
class Tracking implements \Sajari\Internal\Proto
{
  /** @var integer $type */
  private $type;

  /** @var string $query_id */
  private $query_id;

  /** @var integer $sequence */
  private $sequence;

  /** @var string $field */
  private $field;

  /** @var array $data */
  private $data;

    /**
     * Tracking constructor.
     */
    public function __construct()
  {
    $this->type = \Sajari\Api\Query\V1\SearchRequest_Tracking_Type::NONE;
    $this->sequence = 0;
  }

    /**
     * @param string $field
     */
    public function click($field)
  {
    $this->field = $field;
    $this->type = \Sajari\Api\Query\V1\SearchRequest_Tracking_Type::CLICK;
  }

    /**
     * @param string $field
     */
    public function posNeg($field)
  {
    $this->field = $field;
    $this->type = \Sajari\Api\Query\V1\SearchRequest_Tracking_Type::POS_NEG;
  }

    /**
     * @param array $data
     */
    public function setData(array $data)
  {
      $this->data = $data;
  }

    /**
     * @return \Sajari\Api\Query\V1\SearchRequest_Tracking
     */
    public function Proto()
  {
    $t = new \Sajari\Api\Query\V1\SearchRequest_Tracking();

    $t->setQueryId($this->query_id);
    $t->setSequence($this->sequence);

    if (isset($this->data)) {
      foreach($this->data as $key => $value) {
        $dataEntry = new \Sajari\Api\Query\V1\SearchRequest_Tracking_DataEntry();
        $dataEntry->setKey($key);
        $dataEntry->setValue($value);
        $t->addData($dataEntry);
      }
    }

    $t->setType($this->type);
    if ($this->type != \Sajari\Api\Query\V1\SearchRequest_Tracking_Type::NONE) {
      $t->setField($this->field);
    }

    return $t;
  }
}
