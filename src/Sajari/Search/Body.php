<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/engine/query/v1/query.php';

use sajari\engine\query\v1\Body as EngineBody;

class Body
{
  private $text;
  private $weight;

  public function __construct($text, $weight)
  {
    $this->text = $text;
    $this->weight = $weight;
  }

  public function Proto() {
    $b = new EngineBody();

    $b->setText($this->text);
    $b->setWeight($this->weight);

    return $b;
  }
}
