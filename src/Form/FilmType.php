<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('synopsis')
            ->add('dateSortie', DateType::class, [
                'html5' => true,
                'widget' => 'single_text'
            ])
            ->add('artistes', EntityType::class,[
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('photoFile', VichImageType::class, [
                'label' => 'photo',
                'allow_delete' => true,
                'download_uri' => true,
                'image_uri' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
