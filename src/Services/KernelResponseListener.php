<?php
    namespace App\Services;
    
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

    class KernelResponseListener {
        public function onKernelResponse(FilterResponseEvent $event)
        {
            $response = new Response('dupa');
            $event->setResponse($response);
        }
    }
