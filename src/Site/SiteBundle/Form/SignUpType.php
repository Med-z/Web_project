<?php

namespace Site\SiteBundle\Form;

//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignUpType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('firstname',TextType::class)
            ->add('login',TextType::class)
            ->add('password', PasswordType::class)
            ->add('birthdate', DateType::class, array(
                'years' => range(1935, 2010)
            ))
            ->add('isAdmin', CheckboxType::class,array(
                'required' => false
            ));

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\SiteBundle\Entity\SignUp'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'site_sitebundle_users';
    }


}

