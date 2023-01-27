<?php

namespace App\Form;

use App\Entity\SteamRecentGames;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SteamRecentGamesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profileid', TextType::class, ['label' => 'ID du profil'])
            ->add('timer', IntegerType::class, ['label' => 'timer en seconde'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SteamRecentGames::class,
        ]);
    }
}
