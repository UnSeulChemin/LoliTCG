<?php

namespace App\Form\Edit;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, options:[
                'attr' => [
                    'minlength' => '5',
                    'maxlength' => '30',
                    'placeholder' => 'Email',
                    'autofocus' => null
                ],
                'label' => 'Email'
            ])
            ->add('name', TextType::class, options:[
                'attr' => [
                    'minlength' => '3',
                    'maxlength' => '20',
                    'placeholder' => 'Name',
                ],
                'label' => 'Name'
            ])
            ->add('roles', CollectionType::class, [
                // each entry in the array will be an "text" field
                'entry_type' => TextType::class,
                // these options are passed to each "text" type
                'entry_options' => [
                    'attr' => ['class' => 'email-box', 'placeholder' => 'Role'],
                    'label_attr' => ['class' => 'none'],
                    'label' => 'Roles'
                ],
                'label' => 'Roles'
            ])
            ->add('submit', SubmitType::class, options:[
                'label' => 'Validate',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}