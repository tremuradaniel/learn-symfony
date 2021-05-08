<?php
namespace App\Listeners;
use Symfony\Component\EventDispatcher\Event;

class VideoCreatedListener extends Event {
    public function onVideoCreatedEvent($event)
    {
        dump($event->video->title);
    }
}
