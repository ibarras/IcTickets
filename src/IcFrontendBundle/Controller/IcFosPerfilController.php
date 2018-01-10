<?php

namespace IcFrontendBundle\Controller;

use IcFrontendBundle\Entity\IcFosPerfil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Exception\Exception;

/**
 * Icfosperfil controller.
 *
 * @Route("icfosperfil")
 */
class IcFosPerfilController extends Controller
{
    /**
     * Lists all icFosPerfil entities.
     *
     * @Route("/", name="icfosperfil_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fos = $em->getRepository('IcFrontendBundle:FosUser')->findAll();

        $perfil =$em->getRepository('IcFrontendBundle:IcFosPerfil')->findAll();

        $u =$em->getRepository('IcFrontendBundle:IcFosPerfil')->findOneByNombre($this->getUser());

        return $this->render('IcFrontendBundle:icfosperfil:index.html.twig', array(
             'fos' => $fos,
        ));
    }

    /**
     * Creates a new icFosPerfil entity.
     *
     * @Route("/new", name="icfosperfil_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $valida = $em->getRepository('IcFrontendBundle:IcFosPerfil')->findOneByIdFos($request->get('idFos'));

        if($valida){
            throw new  Exception(' El perfil ya existe');

        }
        $usuario = $em->getRepository('IcFrontendBundle:FosUser')->findOneById($request->get('idFos'));

        $icFosPerfil = new Icfosperfil();
        $icFosPerfil->setIdFos($usuario);

        /**
         * @autor: Martin Ibarra C
         * @date 6 Nov 2017
         *
         * Se implementa la firma del usuario utilizando el algoritmo hash de 256 bits pasandole como parametros
         * el correo de usuario y la cadena (XoloProcesos).
         *
         */
        $icFosPerfil->setFirma(hash('sha256', $usuario->getEmail() . 'XoloProcesos' ));

        $form = $this->createForm('IcFrontendBundle\Form\IcFosPerfilType', $icFosPerfil);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($icFosPerfil);
            $em->flush();

            return $this->redirectToRoute('icfosperfil_show', array('idPerfil' => $icFosPerfil->getIdperfil()));
        }

        return $this->render('IcFrontendBundle:icfosperfil:new.html.twig', array(
            'icFosPerfil' => $icFosPerfil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a icFosPerfil entity.
     *
     * @Route("/{idPerfil}", name="icfosperfil_show")
     * @Method("GET")
     */
    public function showAction(IcFosPerfil $icFosPerfil)
    {
        $deleteForm = $this->createDeleteForm($icFosPerfil);

        return $this->render('IcFrontendBundle:icfosperfil:show.html.twig', array(
            'icFosPerfil' => $icFosPerfil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing icFosPerfil entity.
     *
     * @Route("/{idPerfil}/edit", name="icfosperfil_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IcFosPerfil $icFosPerfil)
    {
        $deleteForm = $this->createDeleteForm($icFosPerfil);
        $editForm = $this->createForm('IcFrontendBundle\Form\IcFosPerfilType', $icFosPerfil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('icfosperfil_edit', array('idPerfil' => $icFosPerfil->getIdperfil()));
        }

        return $this->render('IcFrontendBundle:icfosperfil:edit.html.twig', array(
            'icFosPerfil' => $icFosPerfil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a icFosPerfil entity.
     *
     * @Route("/{idPerfil}", name="icfosperfil_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, IcFosPerfil $icFosPerfil)
    {
        $form = $this->createDeleteForm($icFosPerfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($icFosPerfil);
            $em->flush();
        }

        return $this->redirectToRoute('icfosperfil_index');
    }

    /**
     * Creates a form to delete a icFosPerfil entity.
     *
     * @param IcFosPerfil $icFosPerfil The icFosPerfil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IcFosPerfil $icFosPerfil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('icfosperfil_delete', array('idPerfil' => $icFosPerfil->getIdperfil())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
