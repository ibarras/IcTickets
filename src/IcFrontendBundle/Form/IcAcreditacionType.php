<?php

namespace IcFrontendBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IcAcreditacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $estatus = $options['estatus'];
        $builder
            ->add('solicitante', TextType::class, array('required'    => true, 'label' => 'Solicitante', 'attr' => array('class' => 'form-control')))

            ->add('nombreEnAcreditacion', TextType::class, array('required'    => true, 'label' => 'Nombre en la Acreditacion', 'attr' => array('class' => 'form-control')))

            ->add('puesto', TextType::class, array('required'    => true, 'label' => 'Puesto', 'attr' => array('class' => 'form-control')))

            ->add('patrocinador', TextType::class, array('required'    => true, 'label' => 'Patrocinador/Palcohabiente/Otro', 'attr' => array('class' => 'form-control')))

            ->add('icImagen', FileType::class, array('required'    => true, 'label' => 'Fotografia'))

            ->add('descripcion', TextType::class, array('required'    => true, 'label' => 'Descripcion', 'attr' => array('class' => 'form-control')))

            ->add('cantidad', IntegerType::class, array('required'    => true, 'label' => 'Cantidad de Acreditaciones', 'attr' => array('class' => 'form-control')))

            ->add('idAcreditacionTipo', EntityType::class, array('class' => 'IcFrontendBundle\Entity\IcAcreditacionTipo', 'label' => 'Topo de Acreditacion '))

            ->add('idFosPerfil', EntityType::class,  array('class' => 'IcFrontendBundle\Entity\IcFosPerfil', 'label' => 'Autorizado por: ' ));

//            ->add('idFosPerfil', 'entity_id' , array('class' => 'IcFrontendBundle\Entity\IcFosPerfil' ))
//
//            ->add('idAcreditacionTipo', 'entity_id',  array('class' => 'IcFrontendBundle\Entity\IcAcreditacionTipo'));
//

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IcFrontendBundle\Entity\IcAcreditacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'icfrontendbundle_icacreditacion';
    }


}
