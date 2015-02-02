<?php

namespace Sajari\Common\Exception;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Converts generic Guzzle response exceptions into Sajari specific exceptions.
 */
class ExceptionListener implements EventSubscriberInterface
{
    /**
     * @var ExceptionFactoryInterface Factory used to create new exceptions
     */
    protected $factory;

    /**
     * @param ExceptionFactoryInterface $factory Factory used to create exceptions
     */
    public function __construct(ExceptionFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'request.error' => array('onRequestError', -1),
        );
    }

    /**
     * Throws a more meaningful request exception if available.
     *
     * @param Event $event Event emitted
     */
    public function onRequestError(Event $event)
    {
        $e = $this->factory->fromResponse($event['response']);
        $event->stopPropagation();
        throw $e;
    }
}
