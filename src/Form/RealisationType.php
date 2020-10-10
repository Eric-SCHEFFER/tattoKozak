<?php

namespace App\Form;

use App\Entity\Realisations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('hook')
            ->add('updated_at')

             // On ajoute le champ image dans le formulaire
             // Il n'est pas lié à la base de données (mapped à false)
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => false,
                'mapped' => false

            ])
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisations::class,
        ]);
    }
}
