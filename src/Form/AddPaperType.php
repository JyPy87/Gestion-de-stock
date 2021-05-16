<?php

namespace App\Form;

use App\Entity\Paper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class AddPaperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,
            [
                'constraints'=>new NotBlank(['message'=>'Veuillez completer ce champ']),
            ])
            ->add('reference',TextType::class,
            [
                'constraints'=>new NotBlank(['message'=>'Veuillez completer ce champ']),
            ])
            ->add('quantity', IntegerType::class, 
            [
                'constraints' => new Range(['min' => 0]),
                'attr' => ['min' => 0],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paper::class,
        ]);
    }
}
