<?php

namespace IcFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('IcFrontendBundle:Default:index.html.twig');
    }

    public function tipoControlAction()
    {
        return $this->render('IcFrontendBundle:Default:tipocontrol.html.twig');
    }

    public function tipoSolicitudAction()
    {
        return $this->render('IcFrontendBundle:Default:tiposolicitud.html.twig');
    }

    public function menuAction()
    {
        return $this->render('IcFrontendBundle:Default:menu.html.twig');
    }
    public function mensajesAction()
    {
        return $this->render('IcFrontendBundle:Default:mensajes.html.twig');
    }
    public function statusAction()
    {
        return $this->render('IcFrontendBundle:Default:status_solicitud.html.twig');
    }
    public function mensajeNuevoAction()
    {
        return $this->render('IcFrontendBundle:Default:nuevo_mensaje.html.twig');
    }
    public function reporteAction()
    {
        return $this->render('IcFrontendBundle:Default:reportes.html.twig');
    }
}
