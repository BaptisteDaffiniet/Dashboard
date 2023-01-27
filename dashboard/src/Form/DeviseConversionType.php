<?php

namespace App\Form;

use App\Entity\DeviseConversion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviseConversionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('devise_target', ChoiceType::class, [
                'choices' => [
                    'EUR' => 'EUR',
                    'AUD' => 'AUD',
                    'BTC' => 'BTC',
                    'CAD' => 'CAD',
                    'JPY' => 'JPY',
                    'RUB' => 'RUB',
                    'NZD' => 'NZD'
                ]
            ])
            ->add('devise_format', ChoiceType::class, [
                'choices' => [
                    'EUR' => 'EUR',
                    'AUD' => 'AUD',
                    'BTC' => 'BTC',
                    'CAD' => 'CAD',
                    'JPY' => 'JPY',
                    'RUB' => 'RUB',
                    'NZD' => 'NZD'
                ]
            ])
            ->add('quantity', IntegerType::class, ['label' => 'quantité à convertir'])
            ->add('timer', IntegerType::class, ['label' => 'timer en seconde'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DeviseConversion::class,
        ]);
    }
}
