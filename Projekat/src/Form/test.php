<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class test extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label'              => 'USER_EMAIL',
                'translation_domain' => 'messages',
                'attr'               => [
                    'class' => 'form-control',
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'            => PasswordType::class,
                'options'         => [
                    'translation_domain' => 'FOSUserBundle',
                    'attr'               => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options'   => [
                    'label' => 'form.password',
                    'attr'  => [
                        'class' => 'form-control',
                    ]
                ],
                'second_options'  => [
                    'label'      => 'form.password_confirmation',
                    'attr'       => [
                        'class' => 'form-control',
                    ],
                    'label_attr' => [
                        'class' => 'mt-15',
                    ]
                ],
                'invalid_message' => 'fos_user.password.mismatch',
            ])
            ->add('firstName', TextType::class, [
                'label'              => 'USER_FIRST_NAME',
                'translation_domain' => 'messages',
                'attr'               => [
                    'class' => 'form-control',
                ]
            ])
            ->add('lastName', TextType::class, [
                'label'              => 'USER_LAST_NAME',
                'translation_domain' => 'messages',
                'attr'               => [
                    'class' => 'form-control',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label'    => 'USER_GENDER',
                'required' => true,
                'choices'  => [
                    'USER_GENDER_MALE'   => 'Male',
                    'USER_GENDER_FEMALE' => 'Female',
                ],
                'attr'     => [
                    'class' => 'form-control',
                ],
            ]);

        $builder->remove('username');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
