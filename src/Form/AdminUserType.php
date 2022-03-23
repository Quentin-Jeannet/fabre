<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ["label"=>"tableHeaders.firstname"])
            ->add('name', TextType::class, ["label"=>"tableHeaders.name"])
            ->add('email', TextType::class, ["label"=>"tableHeaders.email"])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'tableHeaders.password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->remove('roles')
            ->remove('institutionName')
            ->remove('businessAddress')
            ->remove('city')
            ->remove('zipcode')
            ->remove('country')
            ->remove('mobilePhone')
            ->remove('isWaitingCertificate')
            ->remove('speciality')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
