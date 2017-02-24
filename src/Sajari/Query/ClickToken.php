<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

/**
 * Class ClickToken
 * @package Sajari\Query
 */
class ClickToken
{
  /** @var string $token */
  private $token;

  /**
   * Token constructor
   * @param string $token
   */
  public function __constructor($token)
  {
      $this->token = $token;
  }

  /**
   * Gets Click token
   * @return string
   */
  public function getToken()
  {
      return $this->token;
  }
}
