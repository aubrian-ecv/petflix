<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Pet;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url')
            ->add('title')
            ->add('description')
            ->add('pets', EntityType::class, [
                'class' => Pet::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('member', EntityType::class, [
                'class' => Member::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
