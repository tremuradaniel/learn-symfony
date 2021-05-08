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

    public function onKernelResponse1()
    {
        dump('1');
    }

    public function onKernelResponse2()
    {
        dump('2');
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
//            KernelEvents::RESPONSE => [
//                ['onKernelResponse1', 2],
//                ['onKernelResponse2', 1]
//            ]
        ];
    }
}
