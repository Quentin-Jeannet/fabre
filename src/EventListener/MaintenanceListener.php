<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

// D'après le tuto :
// https://www.youtube.com/watch?v=XOF0gFS8J2Q

class MaintenanceListener{
    private $maintenance;
    private $twig;

    public function __construct( $maintenance, Environment $twig)
    {
        $this->maintenance = $maintenance;
        $this->twig = $twig;
    }
    public function onKernelRequest(RequestEvent $event){

        if(!$event->isMainRequest()){
            return;
        }
       
        if(!file_exists($this->maintenance)){
            return;
        }
        //dd("maintenance");
        $event->setResponse(new Response(
            $this->twig->render("security/maintenance.html.twig"),
            Response::HTTP_SERVICE_UNAVAILABLE
        ));
        $event->stopPropagation();
    }
}