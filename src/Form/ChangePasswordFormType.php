<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),
                        new Length([
                            'min' => 8,
                            'minMessage' => 'Le mot de passe doit avoir au moins {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 255,
                        ]),
                        new Regex([
                            'pattern' => '#[a-z]+#',
                            'match' => true,
                            'message' => 'Doit contenir au moins: 1 minuscule'
                        ]),
                        new Regex([
                            'pattern' => '#[A-Z]+#',
                            'match' => true,
                            'message' => 'Doit contenir au moins: 1 majuscule'
                        ]),
                        new Regex([
                            'pattern' => '#[0-9]+#',
                            'match' => true,
                            'message' => 'Doit contenir au moins: 1 chiffre'
                        ]),
                        new Regex([
                            'pattern' => '#[&)=(?]+#',
                            'match' => true,
                            'message' => 'Doit contenir au moins: l\'un de ces caractères: & ) = ( ?'
                        ]),
                    ],
                    'label' => 'Nouveau mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmation du nouveau mot de passe',
                ],
                'invalid_message' => 'Les 2 mots de passe doivent être identiques',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
