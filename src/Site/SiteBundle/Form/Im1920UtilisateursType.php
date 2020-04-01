<?php

namespace Site\SiteBundle\Form;

use Doctrine\DBAL\Types\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Im1920UtilisateursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('identifiant',TextType::class)
            ->add('motdepasse',PasswordType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('anniversaire', DateType::class, array(
                'years' => range(1950, 2020)
            ))
            ->add('isadmin', CheckboxType::class,array(
                'required' => false
            )); 
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\SiteBundle\Entity\Im1920Utilisateurs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'site_sitebundle_im1920utilisateurs';
    }


}
