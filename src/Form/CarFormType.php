<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'row_attr' => [
                    'class' => 'input'
                ],
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'row_attr' => [
                    'class' => 'input'
                ],
                'required' => false
            ])
            ->add('monthlyPrice', NumberType::class, [
                'row_attr' => [
                    'class' => 'input'
                ],
                'required' => false
            ])
            ->add('dailyPrice', NumberType::class, [
                'row_attr' => [
                    'class' => 'input'
                ],
                'required' => false
            ])
            ->add('places', ChoiceType::class, [
                'multiple' => false,
                'row_attr' => [
                    'class' => 'input'
                ],
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9'
                ]
            ])
            ->add('motor', ChoiceType::class, [
                'multiple' => false,
                'row_attr' => [
                    'class' => 'input'
                ],
                'choices' => [
                    'Manuelle' => 'Manuelle',
                    'Automatique' => 'Automatique',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
