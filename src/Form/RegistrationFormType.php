<?php

namespace App\Form;

use App\DTO\RegistrationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Full Name',
                'attr'  => ['placeholder' => 'Enter your full name'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email address',
                'attr'  => ['placeholder' => 'Enter your email'],
            ])
            ->add('password', RepeatedType::class, [
                'type'          => PasswordType::class,
                'first_options'  => ['label' => 'Password', 'attr' => ['placeholder' => 'Create a password']],
                'second_options' => ['label' => 'Repeat Password', 'attr' => ['placeholder' => 'Confirm your password']],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped'      => false,
                'label'       => 'I agree to the Terms & Conditions',
                'constraints' => [new IsTrue(['message' => 'You must agree to the terms.'])],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => RegistrationDTO::class]);
    }
}
