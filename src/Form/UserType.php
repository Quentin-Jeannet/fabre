<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Speciality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ["label"=>"tableHeaders.firstname"])
            ->add('name', TextType::class, ["label"=>"tableHeaders.name"])
            ->add('email', EmailType::class, ["label"=>"tableHeaders.email"])
            ->remove('roles')
            ->add('institutionName', TextType::class, ["label"=>"tableHeaders.institution"])
            ->add('businessAddress', TextType::class, ["label"=>"tableHeaders.businessAddress"])
            ->add('city', TextType::class, ["label"=>"tableHeaders.city"])
            ->add('zipcode', NumberType::class, ["label"=>"tableHeaders.zipcode"])
            ->add('country', CountryType::class, ["label"=>"tableHeaders.country"])
            ->add('mobilePhone', TextType::class, ["label"=>"tableHeaders.mobilePhone"])
            ->add('isWaitingCertificate', ChoiceType::class, ['choices' => ['choices.yes' => true, 'choices.no' => false], "label"=>"tableHeaders.isWaitingCertificate"])
            ->add('speciality', EntityType::class, ["class"=>Speciality::class, "label"=>"tableHeaders.speciality"])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'tableHeaders.password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
