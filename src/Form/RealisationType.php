<?php

namespace App\Form;

use App\Entity\Realisations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;
// use Symfony\Component\Form\Extension\Core\Type\DateTimeInterface;


class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Minimum 3 caractères',
                        'max' => 255,
                        'maxMessage' => 'Maximum 255 caractères'
                    ])
                ]
            ])

            ->add('hook', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Minimum 3 caractères',
                        'max' => 255,
                        'maxMessage' => 'Maximum 255 caractères'
                    ])
                ]
            ])





            // ->add('updated_at')

            //TODO: Constraints
            ->add('updated_at', DateTimeType::class, [
                'required' => true,


            ])


            // ->add('updated_at', DateTimeType::class, [
            //     'required' => true,
            //     'widget' => 'single_text',
            //     'html5' => false,
            //     'constraints' => [
            //         DateTimeInterface()



            //     ]

            // ])








            // On ajoute le champ image dans le formulaire
            // Il n'est pas lié à la base de données (mapped à false)
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => false,
                'multiple' => true,
                'mapped' => false

            ])

            ->add('description', TextareaType::class, [
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Minimum 3 caractères',
                        'max' => 47000,
                        'maxMessage' => 'Maximum 47000 caractères'
                    ])
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisations::class,
        ]);
    }
}
