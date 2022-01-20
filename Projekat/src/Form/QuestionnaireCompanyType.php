<?php

namespace App\Form;

use App\Entity\Company;
use App\Utils\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label'=> 'Naziv firme:',
            'required' => true
        ])
        ->add('city', ChoiceType::class, [
            'label'=> 'Grad:',
            'required' => true,
            'choices' => $options['cities']
        ])
        ->add('address', TextType::class, [
            'label'=> 'Adresa:',
            'required' => true
        ])
        ->add('phoneNumber', TextType::class, [
            'label'=> 'Broj telefona:',
            'required' => false
        ])
        ->add('secondPhoneNumber', TextType::class, [
            'label'=> 'Drugi broj telefona:',
            'required' => false
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Sačuvaj'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
            'cities' => Cities::cities
        ]);
    }
}
