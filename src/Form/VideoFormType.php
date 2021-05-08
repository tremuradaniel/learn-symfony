<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', TextType::class, [
                'label' => 'Set Video Title'
            ])
            ->add('description', TextType::class, [
                'label' => 'Set Description'
            ])
            ->add('size', IntegerType::class)
            ->add('duration', IntegerType::class)
//            ->add('created_at', DateType::class, [
//                'label' => 'Set date',
//                'widget' => 'single_text',
//                'required' => false
//            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add a video'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Agree?',
                'mapped' => false
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $video = $event->getData();
            $form = $event->getForm();
            if (!$video || null === $video->getId())
            {
                $form->add('created_at', DateType::class, [
                    'label' => 'Set date',
                    'widget' => 'single_text'
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
