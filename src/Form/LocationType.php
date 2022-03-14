<?php

namespace App\Form;

use App\Entity\Rent;
use App\Entity\Residence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('arrivalDate', DateTimeType::class, [
                'label' => 'Date d\'arrivée',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => [
                    'class' => 'js-datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd/mm/yyyy',
                    'data-date-language' => 'fr',
                    'data-date-autoclose' => 'true',
                ],
            ])
            ->add('departureDate', DateTimeType::class, [
                'label' => 'Date de départ',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/mm/yyyy',
                'attr' => [
                    'class' => 'js-datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd/mm/yyyy',
                    'data-date-language' => 'fr',
                    'data-date-autoclose' => 'true',
                ],
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
