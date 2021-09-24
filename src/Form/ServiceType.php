<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            //->add('image')

            ->add('image', FileType::class, [
                'label' => 'Ajouter une image',
                'data_class'=>null,
                'required'   => true,
            ])

            ->add('price')

            ->add('category', EntityType::class, array(
                'help' => 'Vous pouvez selectionner une catégorie',
                'class' => Category::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => function(Category $category) {
                    return sprintf('%s', $category->getName());
                },
            ))

                        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
