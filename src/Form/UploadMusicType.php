<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class UploadMusicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mp3file', FileType::class, [
                'label' => 'Fichier mp3',
                'mapped' => 'false',
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'audio/mpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid MP3 file',
                    ])
                ],
            ])
        ->add('filename', TextType::class, [
            'label' => 'Nom du fichier qui seras utiliser pour le bot : ',
            'mapped' => 'false',
        ])
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'Sauvegarder'],
        ]);;
    }
}