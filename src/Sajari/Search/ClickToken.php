<?php

namespace Sajari\Search;

class ClickToken
{
  /** @var string $click */
  private $click;

  /**
   * Token constructor
   * @param string $click
   */
  public function __constructor(string $click)
  {
      $this->pos = $click;
  }

  /**
   * Gets Click token
   * @return string
   */
  public function getClick()
  {
      return $this->clicks;
  }
}
