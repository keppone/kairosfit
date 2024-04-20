<?php

namespace App\Form; 

use App\Entity\PartnerSearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class PartnerSearchType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('partnerActive', CheckboxType::class,[
                'required'=>false,
                'label'=>'Partenaires actifs' 
            ])
            
            ->add('partnerInactive', CheckboxType::class,[
                'required'=>false,
                'label'=>'Partenaires inactifs' 
            ])
            ->add('searchWord', TextType::class, [
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder' => 'Rechercher'
                    ]
                ])
        ;        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
        'data_class' => PartnerSearchData::class,
        'method'=>'GET',
        'csrf_protection'=> false
       ]); 
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
