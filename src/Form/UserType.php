<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'constraints'=>new NotBlank(),
            ])

            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => "ROLE_USER",
                    'Administrateur' => 'ROLE_ADMIN',
                    'Super Administrateur'=>'ROLE_SUPERADMIN',
                ],
                'expanded'  => false, // liste déroulante
                'multiple'  => true, // choix multiple
            ])

            ->add('password',PasswordType::class,[
                'constraints'=>new NotBlank(),
            ])
            ->add('firstname',TextType::class,[
                'constraints'=>new NotBlank(),
            ])
            ->add('lastname',TextType::class,[
                'constraints'=>new NotBlank(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
