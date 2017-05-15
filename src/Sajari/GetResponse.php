<?php

namespace Sajari;

class GetResponse
{
    private $record;
    private $status;

    public function __construct(array $record, Status $status) {
        $this->record = $record;
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function isError() {
        return $this->getStatus()->isError();
    }
    
    public function getRecord() {
        return $this->record;
    }
}
