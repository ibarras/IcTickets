<?php

namespace IcFrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class IcFosPerfilType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre', 'attr'=> array('class' => 'form-control')
            ))
            ->add('apellido', TextType::class, array(
                'label' => 'Apellido', 'attr'=> array('class' => 'form-control')
            ))
            ->add('telefono', TextType::class, array(
                'label' => 'Teléfono', 'attr'=> array('class' => 'form-control')
            ))
            ->add('idDireccion', 'entity',
                array( 'class' => 'IcFrontendBundle\Entity\IcDireccion',
                'label' => 'Direccion', 'attr'=> array('class' => 'form-control')
            ))
            ->add('idCentro', 'entity',
                array('class' => 'IcFrontendBundle\Entity\IcCentroTrabajo',
                    'label' => 'Centro de Trabajo','attr' => array('class' => 'form-control')
                ))
            ->add('idGerencia', 'entity',
                array('class' => 'IcFrontendBundle\Entity\IcGerencia',
                    'label' => 'Gerencia', 'attr'=> array('class' => 'form-control')
            ))
            ->add('idArea', 'entity',
                array('class' => 'IcFrontendBundle\Entity\IcArea',
                    'label' => 'Área' , 'attr' => array('class' => 'form-control')
            ))
            ->add('idPuesto', 'entity',
                array('class' => 'IcFrontendBundle\Entity\IcPuesto',
                    'label' => '', 'attr' => array('class'=>'form-control')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IcFrontendBundle\Entity\IcFosPerfil'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'icfrontendbundle_icfosperfil';
    }


}
