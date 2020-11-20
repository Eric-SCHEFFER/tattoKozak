<?php

namespace App\Form;

use App\Entity\AProposEtInfos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SloganType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('slogan', TextType::class, [
            'required' => true,
            'constraints' => [
                new Length([
                    'min' => 3,
                    'minMessage' => 'Minimum 3 caractères',
                    'max' => 255,
                    'maxMessage' => 'Maximum 255 caractères'
                ])
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AProposEtInfos::class,
        ]);
    }
}
