<?php

namespace App\Form;

use App\Entity\InfoBus;
use App\Entity\InfosClient;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

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
                'help' => 'Warning: Buses do not run on Sundays !',
                'help_attr'=> ['class'=> 'text-danger fs-6 d-none'],
                'attr' => ['class' => 'd-block', 'min'=> date('Y-m-d')],
            ])
            ->add('lastStep', ButtonType::class, [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => 'Last step',
            ])
            ->add('name')
            ->add('numberPersons', null , [
                'label' => 'Number of persons',
                'help' => 'Warning: The number max is 19 persons',
                'help_attr'=> ['class'=> 'text-danger fs-6 d-none'],
            ])
            ->add('roomNumber')
            ->add('telephoneCode',ChoiceType::class, [
                'label' => 'Country Code',
                'choices'  => [
                    '+1 Usa' => 1,
                    '+7 Rus' => 7,
                    '+33 Fr' => 33,
                    '+34 Es' => 34,
                ],
                
            ])
            ->add('whatsAppNumber', TelType::class, [
                'label' => 'Telephone'
            ])
            ->add('validate', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
            ])
/*             ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'infosClient',

            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfosClient::class,
        ]);
    }
}
