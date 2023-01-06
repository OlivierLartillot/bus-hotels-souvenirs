<?php

namespace App\Controller\Admin;

use App\Entity\InfoBus;
use DateTime;
use DateTimeInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class InfoBusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfoBus::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('hotel'),
            TimeField::new('hour')->renderAsNativeWidget(false)->setFormat('short'),
            AssociationField::new('location'),
        ];
    }
    
}
