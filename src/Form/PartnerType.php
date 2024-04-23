<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\User;
use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('activate')
            ->add('email')
            ->add('commercial_contact')
            ->add('rooms', EntityType::class, [
                    'class' => Room::class,
                    'choice_label' => 'city',
                    'multiple' =>true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
            'translation_domain'=>'forms'
        ]);
    }
}
