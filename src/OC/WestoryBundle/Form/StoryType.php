<?php

namespace OC\WestoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',      TextType::class, array(
                'label'     => 'Titre de l\'histoire'
            ))
            ->add('postLimit',  IntegerType::class, array(
                'attr' => array(
                    'min' => 10,
                    'max' => 50
                ),
                'label'     => 'Nombre de chapitres'
            ))
            ->add('intro',      TextareaType::class, array(
                'label'     => 'Introduction (Premier chapitre) de l\'histoire'
            ))
            ->add('submit',     SubmitType::class, array(
                'label'     => 'Envoyer'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\WestoryBundle\Entity\Story'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_westorybundle_story';
    }


}
