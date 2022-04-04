<?php

namespace App\Form;

use App\Entity\Rent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('inventoryFile')
            ->add('arrivalDate')
            ->add('departureDate')
            ->add('tenantComments')
            ->add('tenantSignature')
            ->add('tenantValidatedAt')
            ->add('representativeComments')
            ->add('representativeSignature')
            ->add('representativeValidatedAt')
            ->add('tenant')
            ->add('residence')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rent::class,
        ]);
    }
}
