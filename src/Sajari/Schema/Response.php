<?php

namespace Sajari\Schema;

/**
 * Class Response
 * @package Sajari\Schema
 */
class Response
{
    /** @var \Sajari\Engine\Status $status */
    private $status;

    private function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @param \sajari\engine\schema\Response $response
     * @return Response
     */
    public static function FromProto(\sajari\engine\schema\Response $response)
    {
        $statuses = [];
        foreach ($response->getStatusList() as $status) {
            $statuses[] = \Sajari\Engine\Status::FromProto($status);
        }
        return new Response($statuses);
    }
}