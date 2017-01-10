<?php

namespace Sajari\Query;

class Transform implements \Sajari\Engine\Proto
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
        return new Transform($identifier, \sajariGen\api\query\v1\Transform\RunType::PRE_QUERY);
    }

    /**
     * @param string $identifier
     * @return Transform
     */
    public static function PostNonEmpty($identifier)
    {
        return new Transform($identifier, \sajariGen\api\query\v1\Transform\RunType::POST_NON_EMPTY);
    }

    /**
     * @param string $identifier
     * @return Transform
     */
    public static function PostEmptyPreRetry($identifier)
    {
        return new Transform($identifier, \sajariGen\api\query\v1\Transform\RunType::POST_EMPTY_PRE_RETRY);
    }

    /**
     * @return \sajariGen\api\query\v1\Transform
     */
    public function Proto()
    {
        $protoTransform = new \sajariGen\api\query\v1\Transform();
        $protoTransform->setIdentifier($this->identifier);
        $protoTransform->setRunType($this->runType);
        return $protoTransform;
    }
}
