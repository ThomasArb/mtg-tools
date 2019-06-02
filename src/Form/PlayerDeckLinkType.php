<?php

namespace App\Form;

use App\Entity\Deck;
use App\Entity\Player;
use App\Entity\PlayerDeckLink;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerDeckLinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('player', EntityType::class, [
                'class'=> Player::class,
                'choice_label' => 'name',
            ])
            ->add('deck', EntityType::class, [
                'class' => Deck::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayerDeckLink::class,
        ]);
    }
}
