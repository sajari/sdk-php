<?php

namespace Sajari\Engine\Exception\Parser;

use Guzzle\Http\Message\Response;
use Sajari\Common\Exception\Parser\AbstractJsonExceptionParser;

/**
 * Parses engine exception responses.
 */
class EngineExceptionParser extends AbstractJsonExceptionParser
{
    /**
     * @var array Array of messages and their corresponding codes
     */
    private static $codeMessageMap = array(
        'InvalidCollectionAndPort' => 'failed to parse collection and port',
        'ReadRequestsDisabled' => 'Read requests are currently disabled',
        'WriteRequestsDisabled' => 'Write requests are currently disabled',
        'InvalidHmac' => 'Invalid HMAC',
        'InvalidAccessKey' => 'Invalid access key',
        'InputDataUninterpretable' => 'Unable to interpret input data',
        'InvalidDocumentId' => 'Invalid document id',
        'DocumentAlreadyExists' => 'Document already exists',
        'NoSuchDocument' => 'Document does not exist',
    );

    /**
     * {@inheritdoc}
     */
    protected function doParse(array $data, Response $response)
    {
        if (isset($data['parsed']) && $json = $data['parsed']) {
            $data['errors'] = isset($json['errors']) ? $json['errors'] : array();
            $data['message'] = $this->determineMessageFromErrors($data['errors']);
            $data['code'] = $this->determineCode($response, $data, $json);
        }

        return $data;
    }

    /**
     * Determine an exception code from the given response, exception data and
     * JSON body.
     *
     * @param Response $response
     * @param array    $data
     * @param array    $json
     *
     * @return string|null
     */
    private function determineCode(Response $response, array $data, array $json)
    {
        if (409 === $response->getStatusCode()) {
            return 'DocumentAlreadyExists';
        }

        return $this->determineCodeFromErrors($data['errors']);
    }

    /**
     * Determine an exception message from given the collection of errors.
     *
     * The message is a comma-separated string of each error message.
     *
     * @param array $errors
     *
     * @return string|null
     */
    private function determineMessageFromErrors(array $errors)
    {
        return implode(', ', $errors);
    }

    /**
     * Determine an exception code from the given collection of errors.
     *
     * The code is determined from the first error message that is found in the
     * message-code map.
     *
     * @staticvar array $messageCodeMap
     *
     * @param array $errors
     *
     * @return string|null
     */
    private function determineCodeFromErrors(array $errors)
    {
        static $messageCodeMap;
        $messageCodeMap = array_flip(static::$codeMessageMap);

        foreach ($errors as $error) {
            if (isset($messageCodeMap[$error])) {
                return $messageCodeMap[$error];
            }
        }

        return;
    }
}
