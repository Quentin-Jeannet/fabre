<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Speciality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isAttendingMeeting', ChoiceType::class, [
                'choices' => [
                    'choices.yes' =>true,
                    'choices.no' =>false,
                ],
                "expanded" => true,
                "multiple" => false,
                "label"=>"tableHeaders.meeting",
                ])
            ->add('isRemotely', ChoiceType::class, [
                'choices' => [
                    'choices.yes' =>true,
                    'choices.no' =>false,
                ],
                "expanded" => true,
                "multiple" => false,
                "label"=>"tableHeaders.remotely",
                'data' => null,
                'required' => false,
                'placeholder' => false

                ])
            ->add('isNeedTrain', ChoiceType::class, [
                'choices' => [
                    'choices.yes' =>true,
                    'choices.no' =>false,
                ],
                "expanded" => true,
                "multiple" => false,
                "label"=>"tableHeaders.train",
                'required' => false,
                'placeholder' => false
                ],
                )
            ->add('trainStation', TextType::class, [
                "label"=>"tableHeaders.station",
                "label_attr" => ["class" =>"col-md-8"],
                "required" => false,
                
                ])
            ->add('isNeedFlight', ChoiceType::class, [
                'choices' => [
                    'choices.yes' =>true,
                    'choices.no' =>false,
                ],
                "expanded" => true,
                "multiple" => false,
                "label"=>"tableHeaders.flight",
                'required' => false,
                'placeholder' => false
                ])
            ->add('airport', TextType::class, [
                "label"=>"tableHeaders.airport",
                "label_attr" => ["class" =>"col-md-8"],
                "required" => false,
                ])
            ->add('isNeedHotel', ChoiceType::class, [
                'choices' => [
                    'choices.yes' =>true,
                    'choices.no' =>false,
                ],
                "expanded" => true,
                "multiple" => false,
                "label"=>"tableHeaders.hotel",
                'required' => false,
                'placeholder' => false

                ])
            ->add('firstname', TextType::class, ["label"=>"tableHeaders.firstname"])
            ->add('name', TextType::class, ["label"=>"tableHeaders.name"])
            ->add('email', EmailType::class, ["label"=>"tableHeaders.email"])
            ->remove('roles')
            ->add('institutionName', TextType::class, ["label"=>"tableHeaders.institution"])
            ->add('businessAddress', TextType::class, ["label"=>"tableHeaders.businessAddress"])
            ->add('city', TextType::class, ["label"=>"tableHeaders.city"])
            ->add('zipcode', NumberType::class, ["label"=>"tableHeaders.zipcode"])
            ->add('country', CountryType::class, ["label"=>"tableHeaders.country", "data" => "France"])
            ->add('mobilePhone', TextType::class, ["label"=>"tableHeaders.mobilePhone"])
            ->add('isWaitingCertificate', ChoiceType::class, ['choices' => ['choices.yes' => true, 'choices.no' => false], "label"=>"tableHeaders.isWaitingCertificate"])
            ->add('speciality', EntityType::class, ["class"=>Speciality::class, "label"=>"tableHeaders.speciality"])
            // ->add('password', PasswordType::class, [
            //     // instead of being set onto the object directly,
            //     // this is read and encoded in the controller
            //     "label" => "tableHeaders.password",
            //     'mapped' => false,
            //     'attr' => ['autocomplete' => 'new-password'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter a password',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'Your password should be at least {{ limit }} characters',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
