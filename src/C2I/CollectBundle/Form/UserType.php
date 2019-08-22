<?php

namespace C2I\CollectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname',TextType::class)
        ->add('lastname',TextType::class)
        ->add('dateOfBirth',DateType::class, 
            [
                'widget' => 'single_text',
            ])
        ->add('hasDriverLicence', CheckboxType::class, array('attr'=>['id'=>'Checked'],'label' => 'Avez vous le permis?','required' => false))
        ->add('car',EntityType::class,array(
           'placeholder' => 'Modèle',
           'required' => false,
           'class'        => 'C2ICollectBundle:Car',
           'choice_label' => 'name','expanded'=>false,'multiple'=>false))
        ->add('color',EntityType::class,array(
           'placeholder' => 'Couleur',
           'required' => false,
           'class'        => 'C2ICollectBundle:Color',
           'choice_label' => 'name','expanded'=>false,'multiple'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'C2I\CollectBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'c2i_collectbundle_user';
    }


}
