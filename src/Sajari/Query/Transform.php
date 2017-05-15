<?php

namespace Sajari\Query;

\Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

class Transform implements \Sajari\Internal\Proto
{
    /** @var string $identifier */
    private $identifier;

    /** @var int $runType */
    private $runType;

    /**
     * Transform constructor.
     * @param string $identifier
     * @param int $runType
     */
    private function __construct($identifier, $runType)
    {
        $this->identifier = $identifier;
        $this->runType = $runType;
    }

    /**
     * @param string $identifier
     * @return Transform
     */
    public static function PreQuery($identifier)
    {
        return new Transform($identifier, \Sajari\Api\Query\V1\Transform_RunType::PRE_QUERY);
    }

    /**
     * @param string $identifier
     * @return Transform
     */
    public static function PostNonEmpty($identifier)
    {
        return new Transform($identifier, \Sajari\Api\Query\V1\Transform_RunType::POST_NON_EMPTY);
    }

    /**
     * @param string $identifier
     * @return Transform
     */
    public static function PostEmptyPreRetry($identifier)
    {
        return new Transform($identifier, \Sajari\Api\Query\V1\Transform_RunType::POST_EMPTY_PRE_RETRY);
    }

    /**
     * @return \Sajari\Api\Query\V1\Transform
     */
    public function proto()
    {
        $protoTransform = new \Sajari\Api\Query\V1\Transform();
        $protoTransform->setIdentifier($this->identifier);
        $protoTransform->setRunType($this->runType);
        return $protoTransform;
    }
}
