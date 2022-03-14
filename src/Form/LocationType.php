<?php

namespace App\Form;

use App\Entity\Rent;
use App\Entity\Residence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('arrivalDate', DateType::class,[
            'widget' => 'single_text',

            // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => false,

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
        ])
            ->add('departureDate', DateType::class,[
            'widget' => 'single_text',

            // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => false,

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
        ])
            ->add('residence', EntityType::class, [
                'class' => Residence::class,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn-green'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rent::class,
            'translation_domain' => 'forms',
        ]);
    }
}
