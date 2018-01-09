<?php
/**
 * Created by PhpStorm.
 * User: Julio Flores
 * Date: 19/12/17
 * Time: 09:45
 */

namespace IcFrontendBundle\Controller;

use IcFrontendBundle\Entity\IcHistorialTicket;
use IcFrontendBundle\Entity\IcTicket;
use IcFrontendBundle\Form\IcTicketEditType;
use IcFrontendBundle\Form\IcTicketType;
use IcFrontendBundle\IcHelpers\IcConfig;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * IcTicket Controller.
 * @Route("icticket")
 */
class IcTicketController extends Controller
{
    /**
     * Listar todaas las entidades icTicket.
     *
     * @Route("/", name="icticket_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** obtiene todos los tickets a excepcion de los finalizados */
        $ictickets = $em->getRepository('IcFrontendBundle:IcTicket')->showAllTickets();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($ictickets,
            $request->get('page', 1)/*page number*/,
            IcConfig::LIMITE_PAGINADO_GENERAL/*limit per page*/
        );

        return $this->render('IcFrontendBundle:icticket:index.html.twig', array(
            'tickets' => $pagination,
        ));
    }

    /**
     * Muestra el detalle de una Solicitud(ticket)
     * @param id
     * @return object
     */
    public function showAction($id)
    {
        try{

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IcFrontendBundle:IcTicket')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No existe la solicitud a mostrar');
            }

            $asignado = $em->getRepository('IcFrontendBundle:IcTicketAsignado')->findOneBy(array('idTicket'=>$id));
            if (!$asignado)
            {
                $asignado == null;
            }

            $comentarios = $em->getRepository('IcFrontendBundle:IcComentarios')->showAllComents($id);
            if (!$comentarios)
            {
                $comentarios == null;
            }

            return $this->render('IcFrontendBundle:icticket:show.html.twig', array(
                'entity'      => $entity,
                'asignado'    => $asignado,
                'comentarios' => $comentarios,

            ));
        }catch(Exception $e){
            $logger = $this->get('logger');
            $logger->error('IcTicket.showAction ->' . $e);
        }
    }

    /**
     * Crear nueva entidad de Ticket
     * @Route("/new", name="ticket_new")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request)
    {
        try{

            $ticket = new IcTicket();
            $form = $this->createForm(IcTicketType::class,$ticket);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $estatus = $this->getDoctrine()->getRepository('IcFrontendBundle:IcEstatusTicket')->find(IcConfig::ESTATUS_NO_ASIGNADO);

                $ticket->setFechaCreado(new \DateTime('now'));
                $ticket->setIdEstatus($estatus);

                $em->persist($ticket);
                $em->flush();

                if (true == IcConfig::IC_ENVIO_EMAIL) {

                    try{

                        $message = \Swift_Message:: newInstance();

                        $message->setSubject(ucwords('Registro Exitoso de Solicitud de Soporte.'))
                            ->setFrom(IcConfig::MAIL_FROM)
                            ->setTo(array($ticket->getIdUsuarioSolicitante()->getIdFos()->getEmail(), $this->getUser()->getEmail()))
                            ->setBody(
                                $this->renderView(
                                    'IcFrontendBundle:icticket:registerMail.html.twig',
                                    array(
                                        'solicitante' => $ticket->getIdUsuarioSolicitante()->getNombre(),
                                        'fecha' => $ticket->getFechaCreado(),
                                        'estatus' => $ticket->getIdEstatus()->getNombre(),
                                        'problema' => $ticket->getTitulo(),
                                        'descripcion' => $ticket->getDescripcionProblema(),
                                    )), 'text/html');
                        $this->get('mailer')->send($message);

                    }catch(Exception $e){
                        $this->get('session')->getFlashBag()->add('danger',
                            'EMAIL: Ocurrio un error al capturar su solicitud, intentelo mas tarde');
                    }
                }

                return $this->redirect($this->generateUrl('icticket_index'));
            }

            return $this->render('IcFrontendBundle:icticket:new.html.twig', array(
                'entity' => $ticket,
                'form'   => $form->createView(),
            ));

        }catch(Exception $e){
            $logger = $this->get('logger');
            $logger->error('IcTicket.newAction -> '. $e);

        }
    }

    /**
     * Se Crea la forma para editar la entidad IcTicket
     *
     * @param IcTicket $entity
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(IcTicket $entity)
    {
        $form = $this->createForm(IcTicketEditType::class, $entity, array(
            'action' => $this->generateUrl('icticket_update', array('id'=>$entity->getId(), 'status'=>$entity->getEstatus())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label'=>'ACTUALIZAR', 'attr' => array('class'=>'mt-btn btn btn-danger')));

        return $form;
    }

    /**
     * Editar una entidad IcTicket
     *
     * @Route("/{id}/{status}/", name="icticket_update")
     * @Method("PUT")
     * @Template("IcFrontendBundle::icticket/edit.html.twig")
     */
    public function updateAction(Request $request, $id, $status)
    {
        $em = $this->getDoctrine()->getManager();

        $r = $request->get('status');

        $entity = $em->getRepository('IcFrontendBundle:IcTicket')->find($id);

        if (!$entity){
            throw $this->createNotFoundException('No se encontro el comunicado para actualizar');
            $this->get('session')->getFlashBag()->add('warning', 'No se encontro el comunicado a actualizar');
        }

        $entity->setEstatus($status);

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()){

            // aqui se tiene setear el nuevo id estatus
            // para eso con el getEstatus se hace una solicitud a la tabla estatus
            // porque necesita ser un objeto
            $nuevoestatus = $em->getRepository('IcFrontendBundle:IcEstatusTicket')->findOneById($r);

            if ($editForm->get('idEstatus')->getData()->getId() == IcConfig::ESTATUS_TRABAJANDO)
            {
                $entity->setFechaTrabajando(new \DateTime('now'));
            }
            elseif ($editForm->get('idEstatus')->getData()->getId() == IcConfig::ESTATUS_FINALIZADO)
            {
                $entity->setFechaFinalizado(new \DateTime('now'));
            }
            else{}

            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Modificacion Exitosa');
            return $this->redirect($this->generateUrl('icticket_index'));
        }

        return array(
            'entity'=> $entity,
            'edit_form' => $editForm->createView(),
        );
    }

}
