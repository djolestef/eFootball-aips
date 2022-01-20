<?php

namespace App\Form;

use App\Entity\Client;
use App\Utils\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'label'=> 'Ime:',
            'required' => true
        ])
        ->add('lastName', TextType::class, [
            'label'=> 'Prezime:',
            'required' => true
        ])
        ->add('city', ChoiceType::class, [
        'label'=> 'Grad:',
        'required' => true,
        'choices' => $options['cities']
        ])
        ->add('phoneNumber', TextType::class, [
            'label'=> 'Broj telefona:',
            'required' => false
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Sačuvaj'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            'cities' => Cities::cities
        ]);
    }
}
