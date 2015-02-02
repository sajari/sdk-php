<?php

namespace Sajari\Engine\Exception;

/**
 * Thrown when the document already exists.
 */
class DocumentAlreadyExistsException extends EngineException
{
    /**
     * @var string
     */
    private $engineDocumentId;

    /**
     * @param string$engineDocumentId
     *
     * @return this
     */
    public function setEngineDocumentId($engineDocumentId)
    {
        $this->engineDocumentId = $engineDocumentId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEngineDocumentId()
    {
        return $this->engineDocumentId;
    }
}
