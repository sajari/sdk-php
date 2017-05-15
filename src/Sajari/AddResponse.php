<?php

namespace Sajari;

class AddResponse
{
    private $key;
    private $status;

    public function __construct(Key $key, Status $status) {
        $this->key = $key;
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function isError() {
        return $this->getStatus()->isError();
    }
    
    public function getKey() {
        return $this->key;
    }
}
