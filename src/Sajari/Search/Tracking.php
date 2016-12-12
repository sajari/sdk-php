<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/api/query/v1/query.php';

use sajari\api\query\v1\SearchRequest\Tracking as ApiTracking;
use sajari\api\query\v1\SearchRequest\Tracking\DataEntry;

class Tracking
{
  const NONE = 0;
  const CLICK = 1;
  const POS_NEG = 2;

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
    $this->type = Tracking::NONE;
  }

  public function click($field)
  {
    $this->field = $field;
    $this->type = Tracking::CLICK;
  }

  public function posNeg($field)
  {
    $this->field = $field;
    $this->type = Tracking::POS_NEG;
  }

  public function Proto()
  {
    $t = new ApiTracking();

    $t->setQueryId($this->query_id);
    $t->setSequence($this->sequence);

    if (!is_null($this->data)) {
      foreach($this->data as $key => $value) {
        $dataEntry = new DataEntry();
        $dataEntry->setKey($key);
        $dataEntry->setValue($value);
        $t->addData($dataEntry);
      }
    }

    if ($this->type != Tracking::NONE) {
      $t->setField($this->field);
      $t->setType($this->type);
    }

    return $t;
  }
}
