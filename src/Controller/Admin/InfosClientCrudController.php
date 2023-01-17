<?php

namespace App\Controller\Admin;

use App\Entity\InfosClient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;

class InfosClientCrudController extends AbstractCrudController
{

   
    public static function getEntityFqcn(): string
    {
        return InfosClient::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        
        $sendClient = Action::new('sendClient', 'Envoi Client', 'fa fa-envelope')
            ->setHtmlAttributes(['target' => '_blank'])
            ->linkToRoute('app_whats_app_client', function (InfosClient $infosClient): array {
                return [
                    'client' => $infosClient->getId(),           
                ];
            });

            $sendCommercant = Action::new('sendCommercant', 'Envoi Commercant', 'fa fa-envelope')
            ->setHtmlAttributes(['target' => '_blank'])
            // if the route needs parameters, you can define them:
            // 1) using an array
            ->linkToRoute('app_whats_app_commercant', function (InfosClient $infosClient): array {
                return [
                    'client' => $infosClient->getId(),           
                ];
            });


        //https://symfony.com/bundles/EasyAdminBundle/current/actions.html
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            //->setPermission(Action::NEW, 'ROLE_ADMIN')
            //->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN') 
            ->add(Crud::PAGE_INDEX, $sendClient)
            ->add(Crud::PAGE_DETAIL, $sendClient)
            ->add(Crud::PAGE_INDEX, $sendCommercant)
            ->add(Crud::PAGE_DETAIL, $sendCommercant)
            ->addBatchAction(Action::new('envoiCommercantSwitcher', 'Envoi Commercant Switcher')
                ->linkToCrudAction('envoiCommercantSwitcher')
                ->addCssClass('btn btn-primary')
                ->setIcon('fa fa-user-check'))
            ->addBatchAction(Action::new('envoiClientsSwitcher', 'Envoi Clients Switcher')
                ->linkToCrudAction('envoiClientsSwitcher')
                ->addCssClass('btn btn-primary')
                ->setIcon('fa fa-user-check'))
            ->reorder(Crud::PAGE_INDEX, ['sendClient', 'sendCommercant'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            BooleanField::new('envoiClient'),
            BooleanField::new('envoiCommercant'),
            DateField::new('day', 'Jour'),
            TextField::new('name', 'Nom'),
            IntegerField::new('numberPersons', 'Nbre personnes'),
            IntegerField::new('roomNumber', 'N° chambre'),
            TextField::new('whatsAppNumber', 'WhatsApp'),
            AssociationField::new('bus', 'Hotel'),
        ];
    }

    public function envoiClientsSwitcher(BatchActionDto $batchActionDto)
    {
        $className = $batchActionDto->getEntityFqcn();
        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);
        foreach ($batchActionDto->getEntityIds() as $id) {
            $user = $entityManager->find($className, $id);

            if ($user->isEnvoiClient() == false ) {
                $user->setEnvoiClient(true);
            }
            else {
                $user->setEnvoiClient(false);
            }
        }

        $entityManager->flush();

        return $this->redirect($batchActionDto->getReferrerUrl());
    }
    

    public function envoiCommercantSwitcher(BatchActionDto $batchActionDto)
    {
        $className = $batchActionDto->getEntityFqcn();
        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);
        foreach ($batchActionDto->getEntityIds() as $id) {
            $user = $entityManager->find($className, $id);

            if ($user->isEnvoiCommercant() == false ) {
                $user->setEnvoiCommercant(true);
            }
            else {
                $user->setEnvoiCommercant(false);
            }
        }

        $entityManager->flush();

        return $this->redirect($batchActionDto->getReferrerUrl());
    }



   
}
