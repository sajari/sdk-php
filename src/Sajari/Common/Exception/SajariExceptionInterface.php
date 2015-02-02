<?php

namespace Sajari\Common\Exception;

/**
 * "Marker Interface" implemented by every exception in the Sajari SDK.
 */
interface SajariExceptionInterface
{
    public function getCode();
    public function getLine();
    public function getFile();
    public function getMessage();
    public function getPrevious();
    public function getTrace();
}
