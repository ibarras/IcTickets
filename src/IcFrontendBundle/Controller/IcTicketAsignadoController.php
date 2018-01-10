<?php
/**
 * Created by PhpStorm.
 * User: Julio Flores
 * Date: 28/12/17
 * Time: 11:51
 */

namespace IcFrontendBundle\Controller;

use IcFrontendBundle\Entity\IcHistorialTicket;
use IcFrontendBundle\Entity\IcTicket;
use IcFrontendBundle\Entity\IcTicketAsignado;
use IcFrontendBundle\Form\IcTicketAsignadoType;
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
use Symfony\Component\Validator\Constraints\Date;


/**
 * IcTicketAsignado Controller.
 * @Route("icticketasignado")
 */
class IcTicketAsignadoController extends Controller
{
    /**
     * Crear una nueva entidad IcTicketAsigando.
     *
     * @Route("/", name="icticketasignado_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        try{

            $entity = new IcTicketAsignado();
            $form = $this->createCreateForm($entity);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $entity->setFechaAsignado(new \DateTime('now'));
                $entity->setIdTicket($form->get('idTicket')->getData());
                $em->persist($entity);
                $em->flush();

                $asignado = $em->getRepository('IcFrontendBundle:IcEstatusTicket')->find(IcConfig::ESTATUS_ASIGNADO);
                $ticket = $em->getRepository('IcFrontendBundle:IcTicket')->find($form->get('idTicket')->getData());

                $ticket->setIdEstatus($asignado);
                $em->persist($ticket);
                $em->flush();

                $historial = new IcHistorialTicket();
                $historial->setIdTicket($ticket);
                $historial->setFechaModificacion(new \DateTime('now'));
                $historial->setNuevoEstatus($ticket->getIdEstatus()->getNombre());
                $em->persist($historial);
                $em->flush();


                return $this->redirect($this->generateUrl('icticket_index'));
            }
            return $this->render('IcFrontendBundle:icticketasignado:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));


        }catch(Exception $e){
            $logger = $this->get('logger');
            $logger->error('IcTicketAsignado.createAction -> '. $e);

        }
    }

    /**
     * Crear form para la nueva entidad IcTicketAsignado.
     *
     * @param IcTicketAsignado $entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(IcTicketAsignado $entity)
    {


        $form = $this->createForm(IcTicketAsignadoType::class, $entity, array(
            'action' => $this->generateUrl('icticketasignado_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class,  array('label' => 'ASIGNAR', 'attr' =>array( 'class' => 'mt-btn btn btn-danger')));

        return $form;
    }

    /**
     * Desplegar la forma para crear la nueva entidad IcTicketAsignado.
     * @Route("/{id}/new", name="icticketasignado_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        try{

            $em = $this->getDoctrine()->getManager();
            $ticket = $em->getRepository('IcFrontendBundle:IcTicket')->find($id);

            if(!$ticket){
                throw $this->createNotFoundException('No se pudo encontrar la solicitud(ticket) seleccionada.');
            }

            $entity = new IcTicketAsignado();
            $entity->setIdTicket($ticket);
            $form   = $this->createCreateForm($entity);

            $formView = $form->createView();

            return array(
                'entity' => $entity,
                'form'   => $formView,
            );
        }catch(Exception $e){

        }
    }
}
