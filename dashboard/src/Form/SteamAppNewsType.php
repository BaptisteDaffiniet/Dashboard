<?php

namespace App\Form;

use App\Entity\SteamAppNews;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SteamAppNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('game_id', TextType::class, [
                'label' => 'ID du jeu',
                'attr' => array('min' => 0),
                ])
            ->add('timer', IntegerType::class, ['label' =>'timer en seconde'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SteamAppNews::class,
        ]);
    }
}
