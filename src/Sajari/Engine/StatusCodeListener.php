<?php

namespace Sajari\Engine;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Resets the status code on the response based on the response body JSON.
 */
class StatusCodeListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'request.complete' => array('onRequestComplete', -1),
        );
    }

    /**
     * Reset the status code onto the response.
     *
     * @param Event $event Event emitted
     */
    public function onRequestComplete(Event $event)
    {
        $response = $event['response'];

        // Parse the json
        if (null === $json = json_decode($response->getBody(true), true)) {
            return;
        }
        if (isset($json['statusCode'])) {
            $statusCode = (integer) $json['statusCode'];

            $response->setStatus($statusCode);
        }
    }
}
