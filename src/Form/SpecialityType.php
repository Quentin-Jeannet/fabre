<?php

namespace App\Form;

use App\Entity\Speciality;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isActive', CheckboxType::class, ["label"=>"tableHeaders.isActive", 'row_attr' => ['class' => 'form-switch mb-3']])
            ->add('name', TextType::class, ["label"=>"tableHeaders.name"])
            ->add('slug', TextType::class, ["label"=>"tableHeaders.slug"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Speciality::class,
        ]);
    }
}
