<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/api/query/v1/query.php';

use sajari\api\query\v1\SearchRequest\Tracking as ApiTracking;
use sajari\api\query\v1\SearchRequest\Tracking\DataEntry;
use sajari\api\query\v1\SearchRequest\Tracking\Type;

class Tracking
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

  public function __construct()
  {
    $this->type = Type::NONE;
  }

  public function click($field)
  {
    $this->field = $field;
    $this->type = Type::CLICK;
  }

  public function posNeg($field)
  {
    $this->field = $field;
    $this->type = Type::POS_NEG;
  }

  public function setData(array $data)
  {
      $this->data = $data;
  }

  public function Proto()
  {
    $t = new ApiTracking();

    $t->setQueryId($this->query_id);
    $t->setSequence($this->sequence);

    if (isset($this->data)) {
      foreach($this->data as $key => $value) {
        $dataEntry = new DataEntry();
        $dataEntry->setKey($key);
        $dataEntry->setValue($value);
        $t->addData($dataEntry);
      }
    }

    $t->setType($this->type);
    if ($this->type != Type::NONE) {
      $t->setField($this->field);
    }

    return $t;
  }
}
