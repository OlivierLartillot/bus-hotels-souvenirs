<?php

namespace App\Form;

use App\Entity\InfosClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosClient1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day')
            ->add('name')
            ->add('numberPersons')
            ->add('roomNumber')
            ->add('whatsAppNumber')
            ->add('bus')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfosClient::class,
        ]);
    }
}
