<?php

namespace App\Controller\Admin;

use App\Entity\LieuDeRdv;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LieuDeRdvCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LieuDeRdv::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
