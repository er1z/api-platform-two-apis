<?php


namespace Er1z\MultiApiPlatform\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
//todo is really necessary?
class AttributeFilterSubscriber implements EventSubscriberInterface
{

    public function __construct()
    {

        //$this->contextDiscriminator = $contextDiscriminator;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            'kernel.request'=>['filterRequest', 64]
        ];
    }

    public function filterRequest(GetResponseEvent $event)
    {
        /*$req = $event->getRequest();
        $isInternal = $this->contextDiscriminator->isInternal($req);
        $req->attributes->set('is_internal', $isInternal);*/
    }
}
