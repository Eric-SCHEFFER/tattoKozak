<?php

namespace App\Form;

use App\Entity\AProposEtInfos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AProposType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_entreprise')
            ->add('adresse')
            ->add('complement_adresse')
            ->add('code_postal')
            ->add('ville')
            ->add('telephone')
            ->add('telephone2')
            ->add('autre')
            ->add('email_contact')
            ->add('email_envoi_formulaire')
            ->add('facebook')
            ->add('presentation_a_propos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AProposEtInfos::class,
        ]);
    }
}
