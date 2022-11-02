<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'home.user.firstName',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'home.user.lastName',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('email', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Email(),
                ],
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'home.user.birthdate',
                'widget' => 'single_text',
                'required' => true,
                'attr' => [
                    'class' => 'js-datepicker'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'home.user.actions.create',
                'attr' => [
                    'type' => 'button',
                    'class' => 'btn btn-primary'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}