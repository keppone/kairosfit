<?php

namespace App\Form;

use App\Entity\Partner;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city')
            ->add('postcode')
            ->add('address')
            ->add('activate')
            ->add('mailing')
            ->add('planning')
            ->add('promote')
            ->add('sale')
            ->add('partners', EntityType::class, [
            'class' => Partner::class,
            'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
