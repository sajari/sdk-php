<?php

namespace Sajari\Internal;

class Status
{
    /**
     * @param object
     * @return \Sajari\Status
     */
    public static function fromRpcCallStatus($status)
    {
        return new \Sajari\Status($status->code, $status->details);
    }

    /**
     * @param \Sajari\Rpc\Status $protoStatus
     * @return \Sajari\Status
     */
    public static function fromProto(\Sajari\Rpc\Status $protoStatus)
    {
        return new \Sajari\Status($protoStatus->getCode(), $protoStatus->getMessage());
    }

    /**
     * @param \Sajari\Rpc\Status[] $protoStatus
     * @return \Sajari\Status
     */
    public static function fromProtoStatuses(\Google\Protobuf\Internal\RepeatedField $protoStatuses)
    {
        $statuses = [];
        foreach($protoStatuses as $protoStatus) {
            $statuses[] = Status::fromProto($protoStatus);
        }
        return $statuses;
    }
}

