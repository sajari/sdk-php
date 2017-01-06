<?php

namespace Sajari\Search;

/**
 * Class ClickToken
 * @package Sajari\Search
 */
class ClickToken
{
  /** @var string $click */
  private $click;

  /**
   * Token constructor
   * @param string $click
   */
  public function __constructor($click)
  {
      $this->click = $click;
  }

  /**
   * Gets Click token
   * @return string
   */
  public function getClick()
  {
      return $this->click;
  }
}
