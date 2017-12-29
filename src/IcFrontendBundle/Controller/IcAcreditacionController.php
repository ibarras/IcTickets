<?php

namespace IcFrontendBundle\Controller;

use IcFrontendBundle\Entity\IcAcreditacion;
use IcFrontendBundle\IcHelpers\IcConfig;
use IcFrontendBundle\IcHelpers\IcUpload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use IcFrontendBundle\Entity\IcAcreditacionQr;
use Symfony\Component\Security\Acl\Exception\Exception;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;
use Knp\Bundle\SnappyBundle\Snappy\Response\SnappyResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Icacreditacion controller.
 *
 * @Route("acreditacion")
 */
class IcAcreditacionController extends Controller
{
    /**
     * Lists all icAcreditacion entities.
     *
     * @Route("/", name="acreditacion_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $icAcreditacions = $em->getRepository('IcFrontendBundle:IcAcreditacion')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($icAcreditacions,
            $request->get('page', 1)/*page number*/,
            IcConfig::LIMITE_PAGINADO_GENERAL/*limit per page*/
        );



        return $this->render('IcFrontendBundle:icacreditacion:index.html.twig', array(
            'icAcreditacions' => $pagination,
        ));
    }

    /**
     * Exporta
     *
     * @Route("/exporta", name="acreditacion_exporta")
     * @Method({"GET", "POST"})
     */
    public function exportaAction(Request $request)
    {
        $folio_inicial = $request->get('folio-inicial');
        $folio_final  = $request->get('folio-final');

        if(empty($folio_inicial) || empty($folio_final)) {

            return $this->render('IcFrontendBundle:icacreditacion:exporta.html.twig');
        }

        $em = $this->getDoctrine()->getManager();
        $acreditaciones = $em->getRepository('IcFrontendBundle:IcAcreditacion')->getAcreditaciones($folio_inicial, $folio_final);

        if($request->get('exportar')){

            $response = $this->render('IcFrontendBundle:icacreditacion:csv.html.twig', array('icAcreditacions' => $acreditaciones) );

            $filename = "export_".date("Y_m_d_His").".csv";
            $response->headers->set('Content-Type', 'text/csv');
            $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);

            return $response;
        }

        return $this->render('IcFrontendBundle:icacreditacion:exporta.html.twig', array(
            'icAcreditacions' => $acreditaciones,
        ));
    }


    /**
     * Lists all icAcreditacion entities.
     *
     * @Route("/{id}/lista", name="acreditacion_lista")
     * @Method("GET")
     */
    public function listaAction(IcAcreditacion $icAcreditacion)
    {

        $em = $this->getDoctrine()->getManager();


        if(count($icAcreditacion) > 0 ){

            $icAcreditaciones = $em->getRepository('IcFrontendBundle:IcAcreditacionQr')->findByIdAcreditacion($icAcreditacion->getId());
        }else{
            $this->createNotFoundException('No se encontro la relacion de acreditaciones solicitadas.');
        }

        return $this->render('IcFrontendBundle:icacreditacion:lista.html.twig', array(
            'icAcreditaciones' => $icAcreditaciones,
        ));
    }



    /**
     * Creates a new icAcreditacion entity.
     *
     * @Route("/new", name="acreditacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $icAcreditacion = new Icacreditacion();
        $form = $this->createForm('IcFrontendBundle\Form\IcAcreditacionType', $icAcreditacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $tipo = null;
            $tipo = $form->get('idAcreditacionTipo')->getData();
            $cantidad = $form->get('cantidad')->getData();


            $em->persist($icAcreditacion);

            if ($cantidad == 1) {

                $codigo = $em->getRepository('IcFrontendBundle:IcAcreditacionQr')->findOneBy(
                    array('estatus' => false, 'idAcreditacionTipo' => $tipo)
                );

                if (!$codigo) {

                    throw $this->createNotFoundException('No existen codigos disponibles ');
                    return;

                } else {
                    try {

                        $codigo->setAsignado(new \DateTime());
                        $codigo->setComentario('Se asigno el codigo ');
                        $codigo->setEstatus(true);
                        $codigo->setIdAcreditacion($icAcreditacion);
                        $em->persist($codigo);
                        $em->flush();
                    }catch (\Exception $e){
                        $this->get('session')->getFlashBag()->add('error', 'Ocurrio un error al asignarle un codigo a la Acreditacion');
                        // error logging - need customization
                        $this->get('logger')->error($e->getMessage());
                    }
                }

            } elseif ($cantidad > 1) {

                $codigos = $em->getRepository('IcFrontendBundle:IcAcreditacionQr')->getCodigos($cantidad, false, $tipo);

                if (count($codigos) > 1 ) {

                        foreach($codigos as $c) {

                            $c->setAsignado(new \DateTime());
                            $c->setComentario('Se asigna ');
                            $c->setEstatus(true);
                            $c->setIdAcreditacion($icAcreditacion);
                            $em->persist($c);
                    }

                    $em->flush();

                } else {

                    throw $this->createNotFoundException('No existen codigos disponibles ');
                    return;
                }
            }


            //flush de $icAcreditacion
            $em->flush();

            return $this->redirectToRoute('acreditacion_index');
        }

        return $this->render('IcFrontendBundle:icacreditacion:new.html.twig', array(
            'icAcreditacion' => $icAcreditacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a icAcreditacion entity.
     *
     * @Route("/{id}/show", name="acreditacion_show")
     * @Method("GET")
     */
    public function showAction(IcAcreditacion $icAcreditacion)
    {
        $em = $this->getDoctrine()->getManager();

        if(count($icAcreditacion) > 0 ){

            $icAcreditacions = $em->getRepository('IcFrontendBundle:IcAcreditacionQr')->findOneByIdAcreditacion($icAcreditacion->getId());
        }else{
            $this->createNotFoundException('No se encontro la relacion de acreditaciones solicitadas.');
        }

        $fotografia = ($icAcreditacions->getIdAcreditacion()->getFotografia() == null)?
            'http://procesos.xolos.com.mx/uploads/codigos-qr/fotografia-base.png' :
            'http://procesos.xolos.com.mx/uploads/imagen/acreditaciones/' . $icAcreditacions->getIdAcreditacion()->getFotografia();


        $twigoutput =  $this->renderView('IcFrontendBundle:icacreditacion:pdf.html.twig',
            array('nombre'  => $icAcreditacions->getIdAcreditacion()->getNombreEnAcreditacion(),
                'puesto'    => $icAcreditacions->getIdAcreditacion()->getPuesto(),
                'foto'      => $fotografia,
                'codigo'    => 'http://procesos.xolos.com.mx/uploads/codigos-qr/' . $icAcreditacions->getCodigo().'.png',
               ));

       return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($twigoutput, array('page-width' => 140, 'page-height' => 150 )),
            200,
            array('Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename=' . $icAcreditacions->getIdAcreditacion()->getNombreEnAcreditacion() . '.pdf'
            )
        );

//        return new JpegResponse(
//
//            $this->get('knp_snappy.image')->getOutputFromHtml($twigoutput, array( 'height' => 1653,
//                'width'  => 1181)),
//             $icAcreditacions->getIdAcreditacion()->getNombreEnAcreditacion() . '.jpg'
//
//        );

    }

    /**
     * Displays a form to edit an existing icAcreditacion entity.
     *
     * @Route("/{id}/edit", name="acreditacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IcAcreditacion $icAcreditacion)
    {

        $deleteForm = $this->createDeleteForm($icAcreditacion);
        $editForm = $this->createForm('IcFrontendBundle\Form\IcAcreditacionType', $icAcreditacion);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $cantidad = $editForm->get('cantidad')->getData();
            $tipo = $editForm->get('idAcreditacionTipo')->getData();
            $this->getDoctrine()->getManager()->flush();


            //Actualizamos en la tabla ic_acreditacion_qr el nuevo tipo de acreditacion que se ocupa.
            //Primero liberamos los elementos seleccionados y posteriormente actualizamos al nuevo tipo de acreditacion

            $codigos_actualizar = $em->getRepository('IcFrontendBundle:IcAcreditacionQr')->findByIdAcreditacion($icAcreditacion->getId());

            foreach ($codigos_actualizar as $c) {
                $c->setAsignado(null);
                $c->setEstatus(false);
                $c->setComentario(null);
                $c->setIdAcreditacion(null);
                $em->persist($c);
            }
            $em->flush();

            // generamos la cantidad de las acreditaciones relacionadas   getCodigos($limite = null, $estatus, $tipo)

            $nuevos = $em->getRepository('IcFrontendBundle:IcAcreditacionQr')->getCodigos($cantidad, false, $tipo->getId());

            foreach ($nuevos as $c) {
                $c->setAsignado(new \DateTime());
                $c->setEstatus(true);
                $c->setComentario('Se Reasigno de Acreditacion Tipo ' . $icAcreditacion->getIdAcreditacionTipo()->getNombre());
                $c->setIdAcreditacion($icAcreditacion);
                $em->persist($c);
            }
            $em->flush();
            return $this->redirectToRoute('acreditacion_index');

            // return $this->redirectToRoute('acreditacion_edit', array('id' => $icAcreditacion->getId()));

        }

        return $this->render('IcFrontendBundle:icacreditacion:edit.html.twig', array(
            'icAcreditacion' => $icAcreditacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a icAcreditacion entity.
     *
     * @Route("/{id}", name="acreditacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, IcAcreditacion $icAcreditacion)
    {
        $form = $this->createDeleteForm($icAcreditacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($icAcreditacion);
            $em->flush();
        }

        return $this->redirectToRoute('acreditacion_index');
    }

    /**
     * Creates a form to delete a icAcreditacion entity.
     *
     * @param IcAcreditacion $icAcreditacion The icAcreditacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IcAcreditacion $icAcreditacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acreditacion_delete', array('id' => $icAcreditacion->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


}
