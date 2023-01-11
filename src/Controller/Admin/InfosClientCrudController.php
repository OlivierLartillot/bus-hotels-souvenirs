<?php

namespace App\Controller\Admin;

use App\Entity\InfosClient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;

class InfosClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfosClient::class;
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
   
}
