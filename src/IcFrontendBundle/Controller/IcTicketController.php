<?php
/**
 * Created by PhpStorm.
 * User: Julio Flores
 * Date: 19/12/17
 * Time: 09:45
 */

namespace IcFrontendBundle\Controller;

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

        $ictickets = $em->getRepository('IcFrontendBundle:IcTicket')->findAll();

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
//                para crear la solicitud como usuario logeado
//                $icFosPerfil = $this->getDoctrine()->getRepository('IcFrontendBundle:IcFosPerfil')->findOneByIdFos($this->getUser());
                $estatus = $this->getDoctrine()->getRepository('IcFrontendBundle:IcEstatusTicket')->find(IcConfig::ESTATUS_NO_ASIGNADO);

                $ticket->setFechaCreado(new \DateTime('now'));
                $ticket->setIdEstatus($estatus);

                $em->persist($ticket);
                $em->flush();

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
     * Mostrar formulario para editar una entidad IcTicket existente
     * @Route("/{id}/edit", name="icticket_edit")
     * @Method("GET")
     * @Template
     */
    public function editAction($id)
    {
        try{
            $em= $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IcBackendbundle:IcTicket')->find($id);

            if (!$entity){
                throw $this->createNotFoundException('No se encontro la solicitud a mostrar');
            }

            $editForm = $this->CreateEditForm($entity);

            return array(
                'entity'=> $entity,
                'edit_form' => $editForm->createView(),
            );
        }
        catch (Exception $e){
            $logger = $this->get('logger');
            $logger->error('IcTicket.editAction->'.$e);
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
            'action' => $this->generateUrl('icticket_update', array('id'=>$entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label'=>'ACTUALIZAR', 'attr' => array('class'=>'btn btn-success')));

        return $form;
    }

    /**
     * Editar una entidad IcTicket
     *
     * @Route("/{id}", name="icticket_update")
     * @Method("PUT")
     * @Template("IcFrontendBundle::icticket/edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IcFrontendBundle:IcTicket')->find($id);

        if (!$entity){
            throw $this->createNotFoundException('No se encontro el comunicado para actualizar');
            $this->get('session')->getFlashBag()->add('warning', 'No se encontro el comunicado a actualizar');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()){
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
