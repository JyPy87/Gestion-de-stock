<?php

namespace App\Form;

use App\Entity\Supply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddSupplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
            [
                'constraints'=> new NotBlank(['message'=>'Veuillez completer ce champ']),
            ])
            ->add('reference', TextType::class,
            [
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez completer ce champ']),
                    new Length(['min'=>5,'max'=>5]),
                ]
            ])
            ->add('quantity', IntegerType::class,
            [
                'constraints'=>[
                    new NotBlank(['message'=>'Ne peut être vide']),
                ],
                'attr'=>['min'=>0]
            ])
            ->add('machine')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supply::class,
        ]);
    }
}
