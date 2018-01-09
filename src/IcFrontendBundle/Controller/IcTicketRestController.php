<?php
/**
 *
 * This file is part of the IcProcesosFrontend.
 *
 * (c) Martin Ibarra C. <mic@unixmexico.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Date: 12/26/17
 * Time: 8:30 PM
 */

namespace IcFrontendBundle\Controller;

use IcFrontendBundle\Entity\FosUser;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IcFrontendBundle\IcHelpers\IcUpload;
use Symfony\Component\HttpFoundation\Response;

/**
 * IcTicket Controller.
 * @Route("icticketrest")
 */
class IcTicketRestController extends Controller
{
    /**
     * Listar todaas las entidades icTicket.
     *
     * @Route("/", name="icticketrest_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {

        $username =  'martin'; // $request->getUser();
        $password = 'martin'; //$request->getPassword();


        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');

        $user = $user_manager->findUserByUsername($username);
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();

        ld($password, $user->getPassword());

        if($encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
            $response = new Response(
                'Welcome '. $user->getUsername(),
                Response::HTTP_OK,
                array('Content-type' => 'application/json')
            );
        } else {
            $response = new Response(
                'Username or Password not valid.',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }

ld($response);die;
        /// fin


        //return $this->setBaseHeaders($response);




        $em = $this->getDoctrine()->getManager();
        $ictickets = $em->getRepository('IcFrontendBundle:IcTicket')->findAll();

        $data = array();

        foreach($ictickets as $t )
        {
            $data = array(
                'creado'            => date_format($t->getFechaCreado(), 'd-M-Y'),
                'descripcion'       => $t->getDescripcionProblema(),
                'imagen'            => $t->getImagen(),
                'estatus'           => $t->getIdEstatus()->getNombre(),
                'solicitante'       => $t->getIdUSuarioSolicitante()->getNombre());
        }

        $helpers = $this->get('app.helpers');
        $json =  $helpers->json($data);

        $fs = new Filesystem();
        $fs->dumpFile($this->get('kernel')->getRootDir() . '/../web/uploads/json/tickets_actuales.json', $json );
        return $json;
    }

    /**
     *
     * @Route("/estatus/{estatus}", name="icticketrest_estatus")
     * @Method("GET")
     */
    public function estatusAction(Request $request)
    {
        /**
         * Lista de Estatus de un ticket

          1 =>  "NO ASIGNADO"
          2 =>  "ASIGNADO"
          3 =>  "TRABAJANDO"
          4 =>  "EN ESPERA"
          5 =>  "FINALIZADO"

         */

        $estatus = $request->get('estatus');

        $em = $this->getDoctrine()->getManager();
        $ictickets = $em->getRepository('IcFrontendBundle:IcTicket')->findByIdEstatus($estatus);
        $codigo_estatus = $em->getRepository('IcFrontendBundle:IcEstatusTicket')->findOneById($estatus);

        $data = array();

        if(!$ictickets){
            $data = array('Error 404' => 'No se encontro ningun ticket con el Estatus ' . $estatus . ' Intente con otro criterio');
        }else {

            foreach ($ictickets as $t) {
                $data = array(
                    'creado' => date_format($t->getFechaCreado(), 'd-M-Y'),
                    'descripcion' => $t->getDescripcionProblema(),
                    'imagen' => $t->getImagen(),
                    'estatus' => $t->getIdEstatus()->getNombre(),
                    'solicitante' => $t->getIdUSuarioSolicitante()->getNombre());
            }
        }

        $helpers = $this->get('app.helpers');
        $json =  $helpers->json($data);

        $fs = new Filesystem();
        $fs->dumpFile($this->get('kernel')->getRootDir() . '/../web/uploads/json/tickets_estatus_' . $codigo_estatus->getNombre() . '.json', $json );
        return $json;
    }


    /**
     * Listar todaas las entidades icTicket.
     *
     * @Route("/{id}/show", name="icticketrest_show")
     * @Method("GET")
     */

    public function ticketAction(Request $request)
    {
        $ticket = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $t = $em->getRepository('IcFrontendBundle:IcTicket')->findOneById($ticket);


        if(!$t){
            $data = array('Error 404' => 'No se encontro ningun ticket con ID = ' . $ticket . ' Intente con otro codigo');
        }else {

            $data = array('tickets' => array(
                'ticket'        => $t->getId(),
                'creado'        => date_format($t->getFechaCreado(), 'd-M-Y'),
                'descripcion'   => $t->getDescripcionProblema(),
                'imagen'        => $t->getImagen(),
                'estatus'       => $t->getIdEstatus()->getNombre(),
                'solicitante'   => $t->getIdUSuarioSolicitante()->getNombre()));
        }

        $helpers = $this->get('app.helpers');
        $json =  $helpers->json($data);

        $fs = new Filesystem();
        $fs->dumpFile($this->get('kernel')->getRootDir() . '/../web/uploads/json/'. $ticket . '.json', $json );

        return $json;
    }


}