<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event)
    {
        dump($event->video->title);
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = new Response('dupa');
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }
}
