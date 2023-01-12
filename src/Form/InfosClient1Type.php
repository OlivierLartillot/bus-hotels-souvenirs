<?php

namespace App\Form;

use App\Entity\InfoBus;
use App\Entity\InfosClient;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Locale;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosClient1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder 
        
        ->add('bus', EntityType::class, [
            'class' => InfoBus::class,
            'placeholder' => false,
            'placeholder' => '-- Please  choose a value --',
            // je lui donne le nom d'une fonction de mon entity
            // dans laquelle je fait ce que je veux
            'choice_label' => 'getHotelAndHour',
            /* même solution avec une fonction anonyme
            'choice_label' => function($actor){
                return $actor->getFirstname().' '.$actor->getLastname();
            }*/  
            'query_builder' => function($er) {
                return $er->createQueryBuilder('busList')
                  //        ->
                          ->orderBy('busList.hotel','ASC');
                },
            'attr' => ['class' => 'd-block'],
            'label' => 'Select your residence hotel',
            ])     
            ->add('nextStep', ButtonType::class, [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => 'Next step',
            ])
            ->add('day', null , [
                'widget' => 'single_text',
                'help' => 'Buses do not run on Sundays !',
                'help_attr'=> ['class'=> 'text-danger fs-4'],
                'help_translation_parameters' => [
                    '%day%' => 'Buses don\'t work at Sunday !',
                ],
                'attr' => ['class' => 'd-block'],
            ])
            ->add('lastStep', ButtonType::class, [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => 'Last step',
            ])
            ->add('name')
            ->add('numberPersons', null , [
                'label' => 'Number of persons' 
                ])
            ->add('roomNumber')
            ->add('telephoneCode',ChoiceType::class, [
                'label' => 'Code',
                'choices'  => [
                    'Rus +7' => 7,
                    'Fr +33' => 33,
                    'Usa +1' => 1,
                ],
            ])
            ->add('whatsAppNumber', TelType::class, [
                'label' => 'Telephone'
            ])
            ->add('validate', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'infosClient',

            ]);


            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfosClient::class,
        ]);
    }
}
