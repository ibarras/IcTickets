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

class IcTicketAsignadoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('idTicket', EntityType::class, array('class'=>'IcFrontendBundle\Entity\IcTicket', 'label'=>false, 'choice_label'=>'titulo', 'attr' => array('class' => 'hidden')))

            ->add('idUsuarioAsignado', EntityType::class, array('class'=>'IcFrontendBundle\Entity\IcFosPerfil', 'label'=>'Asignar a: ', 'choice_label'=>'nombre', 'attr'=> array('class'=> 'form-control')));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IcFrontendBundle\Entity\IcTicketAsignado'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'icfrontendbundle_icticketasignado';
    }


}
