<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('hitpoints', IntegerType::class, [
                'disabled' => true,
                'label' => 'Hitpoints',
            ])
            ->add('skill_bonus', IntegerType::class, [
                'disabled' => true,
                'label' => 'Skill Bonus',
            ])
            ->add('armor_class', IntegerType::class, [
                'disabled' => true,
                'label' => 'Armor Class',
            ])
            ->add('attack', IntegerType::class, [
                'disabled' => true,
                'label' => 'Attack',
            ])
            ->add('species', ChoiceType::class, [
                'choices' => [
                    '' => '',
                    'Human (No modifiers)' => 'Human',
                    'Elf (+1 Skill, -1 HP)' => 'Elf',
                    'Dwarf (+1 HP, -1 Skill)' => 'Dwarf',
                    'Halfling (+1 AC, -1 Attack)' => 'Halfling'
                ],
                'choice_attr' => function ($choice, $key, $value) {
                    $descriptions = [
                        '' => '',
                        'Human' => 'No modifiers',
                        'Elf' => '+1 Skill Bonus, -1 Hitpoints',
                        'Dwarf' => '+1 Hitpoints, -1 Skill Bonus',
                        'Halfling' => '+1 Armor Class, -1 Attack',
                    ];
                    return ['data-description' => $descriptions[$value]];
                },
                'required' => true
            ])
            ->add('class', ChoiceType::class, [
                'choices' => [
                    'Fighter (+1 Attack, ability: Power Strike)' => 'Fighter',
                    'Thief (+1 Skill Bonus, ability: Stealth)' => 'Thief',
                    'Magic-User (+1 Spell Power, ability: Magic Missile)' => 'Magic-User',
                    'Cleric (+1 Healing, ability: Heal)' => 'Cleric'
                ],
                'choice_attr' => function ($choice, $key, $value) {
                    $descriptions = [
                        'Fighter' => '+1 Attack, Special ability: Power Strike',
                        'Thief' => '+1 Skill Bonus, Special ability: Stealth',
                        'Magic-User' => '+1 Spell Power, Special ability: Magic Missile',
                        'Cleric' => '+1 Healing, Special ability: Heal',
                    ];
                    return ['data-description' => $descriptions[$value]];
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
