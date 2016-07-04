<?php

namespace Sajari\Search;

require_once __DIR__.'/../proto/query.php';

use sajari\engine\query\MetaBoost;

abstract class MetaBoost
{
    /** @return MetaBoost */
    abstract public function Proto();
}