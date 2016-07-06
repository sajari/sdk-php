<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/doc.php';
require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\Body as ProtoBody;

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
    $b = new ProtoBody();

    $b->setText($this->text);
    $b->setWeight($this->weight);

    return $b;
  }
}
