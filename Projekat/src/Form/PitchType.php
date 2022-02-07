<?php

namespace App\Form;

use App\Entity\Pitch;
use App\Utils\Dimensions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PitchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('price', NumberType::class, [
           'label' => 'Cena po satu:',
           'required' => true
        ])
        ->add('dimensions', ChoiceType::class, [
            'label' => 'Dimenzije terena:',
            'required' => true,
            'choices' => $options['dimensions']
        ])
        ->add('miniGoals', CheckboxType::class, [
            'label' => 'Teren ima minigolove:',
            'required' => false
        ])
        ->add('balls', CheckboxType::class, [
            'label' => 'Teren ima lopte:',
            'required' => false
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Dodaj'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pitch::class,
            'dimensions' => Dimensions::dimensions
        ]);
    }

}
