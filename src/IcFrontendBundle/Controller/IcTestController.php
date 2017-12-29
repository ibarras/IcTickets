<?php

namespace IcFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


/**
 * test controller.
 *
 * @Route("test")
 */

class IcTestController extends Controller
{

    /**
     * Lists all icAcreditacion entities.
     *
     * @Route("/ajax", name="test_ajax")
     * @Method("GET")
     */


    public function ajaxAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {
          //  var_dump('hola');
          //  var_dump($request->get('categoria'));
            $data = array('prueba' => 'alegre');
            $response = new JsonResponse();

            $response->setData(array('prueba' => 'alegre'));

            return $this->renderView('IcFrontendBundle:ictest:ajax.html.twig', array('prueba' => 'alegre'));


        }

        //return $response;
        return $this->render('IcFrontendBundle:ictest:ajax.html.twig');
    }



}
