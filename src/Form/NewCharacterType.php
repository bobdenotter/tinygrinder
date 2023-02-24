<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('race')
            ->add('class')
            ->add('STR')
            ->add('DEX')
            ->add('CON')
            ->add('INT')
            ->add('WIS')
            ->add('CHA')
            ->add('proficiency')
            ->add('speed')
            ->add('HP')
            ->add('maxHP')
            ->add('tempHP')
            ->add('initiative')
            ->add('AC')
            ->add('level')
            ->add('XP')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
