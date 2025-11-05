<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Ukol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UkolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nazev', TextType::class, [
                'label' => 'Název úkolu (povinné)',
            ])
            ->add('popis', TextareaType::class, [
                'label' => 'Popis úkolu',
            ])
            ->add('dokdy', DateType::class, [
                'label' => 'Datum do kdy má být úkol hotov',
                'data' => new \DateTime()
            ])
            ->add('dokonceno')
            ->add('pridat', SubmitType::class, [
                'label' => 'Uložit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ukol::class,
        ]);
    }
}
