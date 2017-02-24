<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class PosNegToken
 * @package Sajari\Query
 */
class PosNegToken
{
  /** @var string $pos */
  private $pos;
  /** @var string $neg */
  private $neg;

  /**
   * Token constructor
   * @param string $pos
   * @param string $neg
   */
  public function __constructor($pos, $neg)
  {
      $this->pos = $pos;
      $this->neg = $neg;
  }

  /**
   * Gets Positive token
   * @return string
   */
  public function getPos()
  {
      return $this->pos;
  }

  /**
   * Gets Negative token
   * @return string
   */
  public function getNeg()
  {
      return $this->neg;
  }
}
