<?php

namespace App\Form;

use App\Entity\Residence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('zipCode', NumberType::class)
            ->add('city', TextType::class)
            ->add('country', CountryType::class)
            ->add('inventoryFile', FileType::class, [
                'mapped' => false
            ])
            ->add('picture', FileType::class, [
                'mapped' => false
            ])
            ->add('submit', SubmitType::class, [
        'label' => 'Mettre à jour les données',
        'attr' => ['class' => 'btn-green'],
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Residence::class,
            'translation_domain' => 'forms',
        ]);
    }
}
