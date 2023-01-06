<?php

namespace App\Controller\Admin;

use App\Entity\InfosClient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            DateField::new('day'),
            TextField::new('name'),
            IntegerField::new('numberPersons'),
            IntegerField::new('roomNumber'),
            TextField::new('whatsAppNumber'),
            AssociationField::new('bus'),



      
        ];
    }
   
}
