<?php

namespace IcFrontendBundle\Controller;

use IcFrontendBundle\Form\IcComentariosType;
use Symfony\Component\HttpFoundation\Request;
use IcFrontendBundle\Entity\IcComentarios;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * IcComentarios Controller.
 * @Route("iccomentarios")
 */
class IcComentariosController extends Controller
{
    /**
     * Desplegar la forma para crear la nueva entidad IcComentarios.
     */
    public function newAction(Request $request, $id)
    {
        try{

            $em = $this->getDoctrine()->getManager();
            $ticket = $em->getRepository('IcFrontendBundle:IcTicket')->find($id);

            if(!$ticket){
                throw $this->createNotFoundException('No se pudo encontrar la solicitud(ticket) seleccionada.');
            }

            $icFosPerfil = $this->getDoctrine()->getRepository('IcFrontendBundle:IcFosPerfil')->findOneByIdFos($this->getUser());
            if(!$icFosPerfil){
                throw $this->createNotFoundException('No existe el usuario logueado');
            }

            $entity = new IcComentarios();
            $entity->setIdTicket($ticket);
            $entity->setIdUsuario($icFosPerfil);
            $form = $this->createForm(IcComentariosType::class, $entity);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $entity->setFechaCreado(new \DateTime('now'));
                $em->persist($entity);
                $em->flush($entity);

                return $this->redirect($this->generateUrl('icticket_index'));
            }
            return $this->render('IcFrontendBundle:iccomentarios:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }catch(Exception $e){
            $logger = $this->get('logger');
            $logger->error('IcComentarios.newAction -> '. $e);
        }
    }
}
