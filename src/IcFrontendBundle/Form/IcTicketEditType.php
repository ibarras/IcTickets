<?php

namespace IcFrontendBundle\Form;


use IcFrontendBundle\IcFrontendBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IcTicketEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('idUsuarioSolicitante', EntityType::class, array('class'=>'IcFrontendBundle\Entity\IcFosPerfil', 'label' => 'Solicitante', 'attr' => array('class' => 'form-control')))

            ->add('descripcionProblema', TextareaType::class, array('label' => 'Descripción del problema', 'attr' => array('class' => 'form-control', 'rows'=>'10')))

            ->add('idEstatus', EntityType::class, array('class'=>'IcFrontendBundle\Entity\IcEstatusTicket','label' => 'Estatus','choice_label' => 'nombre', 'attr' => array('class' => 'form-control')))

            ->add('icImagen', FileType::class, array('required' => false, 'label' => 'Imagen del problema'));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IcFrontendBundle\Entity\IcTicket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'icfrontendbundle_icticket';
    }


}
