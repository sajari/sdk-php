<?php

namespace Sajari\Internal;

class Status
{
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

    /**
     * @param \Sajari\Status
     * @throws \Sajari\Error\AlreadyExistsException
     * @throws \Sajari\Error\Exception
     * @throws \Sajari\Error\InvalidArgumentException
     * @throws \Sajari\Error\NotFoundException
     * @throws \Sajari\Error\PermissionDeniedException
     * @throws \Sajari\Error\ServiceUnavailableException
     * @throws \Sajari\Error\UnauthenticatedException
     */
    public static function checkForError(\Sajari\Status $status)
    {
        switch ($status->getCode()) {
            case \Sajari\Status::OK:
                return;

            case \Sajari\Status::INVALID_ARGUMENT:
                throw new \Sajari\Error\InvalidArgumentException((string)$status, $status->getCode());

            case \Sajari\Status::NOT_FOUND:
                throw new \Sajari\Error\NotFoundException((string)$status, $status->getCode());

            case \Sajari\Status::ALREADY_EXISTS:
                throw new \Sajari\Error\AlreadyExistsException((string)$status, $status->getCode());

            case \Sajari\Status::PERMISSION_DENIED:
                throw new \Sajari\Error\PermissionDeniedException((string)$status, $status->getCode());

            case \Sajari\Status::UNAVAILABLE:
                throw new \Sajari\Error\ServiceUnavailableException((string)$status, $status->getCode());

            case \Sajari\Status::UNAUTHENTICATED:
                throw new \Sajari\Error\UnauthenticatedException((string)$status, $status->getCode());

            default:
                throw new \Sajari\Error\Exception((string)$status, $status->getCode());
        }
    }
}

