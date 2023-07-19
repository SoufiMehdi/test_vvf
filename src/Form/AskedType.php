<?php

namespace App\Form;

use App\Entity\Asked;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class AskedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('askSubject', TextType::class, [
                'label' => 'Suject de la demande'
            ])
            ->add('askDescription', TextareaType::class, [
                'label' => 'Corp de la demande'
            ])
            ->add('askEmailApplicant', EmailType::class, [
                'label' => 'Email du demandeur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asked::class,
        ]);
    }
}
