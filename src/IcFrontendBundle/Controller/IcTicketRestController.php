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

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        return $helpers->json($data);
    }


}