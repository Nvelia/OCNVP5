<?php

namespace OC\WestoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class MembersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',       TextType::class, array(
                'label' => 'Identifiant',
            ))
            ->add('password',       RepeatedType::class, array(
                'type'              => PasswordType::class,
                'invalid_message'   => 'Les mots de passe doivent correspondre.',
                'first_options'     => array('label' => 'Mot de passe'),
                'second_options'    => array('label' => 'Vérification du mot de passe'),
            ))
            ->add('emailAddress',   RepeatedType::class, array(
                'type'      => EmailType::class,
                'first_options'     => array('label' => 'Adresse Email'),
                'second_options'    => array('label' => 'Vérification de l\'adresse Email'),
            ))
            ->add('submit',         SubmitType::class, array(
                'label' => 'Envoyer',
                'attr'  => array('class' => 'submitRegistration'),
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\WestoryBundle\Entity\Members'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_westorybundle_members';
    }


}
