<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Intl\Intl;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $languages = Intl::getLanguageBundle()->getLanguageNames();
        $builder
            ->add('title')
            ->add('release_date')
            ->add('language', ChoiceType::class, array(
                'placeholder' => '',
                'choices' => array_flip($languages),
                'label'=>'language'
            ))
            ->add('length')
            ->add('poster')
            ->add('trailer')
            ->add('synopsis')
            ->add('budget')
            ->add('box_office')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
