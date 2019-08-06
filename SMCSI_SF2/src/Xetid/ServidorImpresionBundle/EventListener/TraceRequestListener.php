<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 18/03/15
 * Time: 15:14
 */

namespace Xetid\ServidorImpresionBundle\EventListener;


use Psr\Log\LoggerInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class TraceRequestListener{

    private $logger;
    private $templating;
    function __construct(LoggerInterface $logger,EngineInterface $templating)
    {
        $this->logger = $logger;
        $this->templating = $templating;
    }
    public function onKernelRequest(GetResponseEvent $event){
        $array = array(
            '/admin/logout',
            '/admin/chages_passwprd',
            '/admin/addgroups',
            '/admin/addgusers',
            '/admin/usuarios',
            '/admin/impresoras',
            '/admin/usertogroups',
            '/admin/deleteuserfromgroups',
            '/admin/deletegroups',
            '/admin/addprintertogroups',
            '/admin/deleteprinterfromgroups',
            '/admin/modprinter',
            '/admin/addgroupprinter',
            '/admin/deleteprintergroups',
            '/admin/modgroups',
            '/admin/deleteusers',
            '/admin/datosgroups',
            '/admin/modusers',
            '/admin/preparaParaModificar',
            '/admin/addprinter',
            '/admin/modprinterbycups',
            '/admin/reset',
            '/admin/getip',
            '/admin/save_changes_ip',
            '/admin/allowall_or_not',
            '/admin/delete_ip',
            '/admin/add_ip',
            '/admin/activate_all',
            '/admin/deactivate_all',
            '/admin/allowdeny'

        );
        if(HttpKernelInterface::MASTER_REQUEST===$event->getRequestType() ){
            $pathInfo= $event->getRequest()->getPathInfo();
            $this->logger->info("*********".$pathInfo);
            if(in_array($pathInfo,$array)){
                $session = new Session();
                $token = $session->get('tokens');
                $session_id = $token['administrador'];
                $this->logger->info($session_id." JOJOJO");
                if(is_null($session) || $session_id === false || $session_id == "" || !isset($session_id)){
                    $view = $this->templating->render("ServidorImpresionBundle:Error:error.html.twig");
                    $event->setResponse(new Response($view));
                }
            }
        }
    }
} 