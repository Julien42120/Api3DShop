<?php

namespace App\Controller\Admin;

use App\Entity\Printing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PrintingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Printing::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('category'),
            AssociationField::new('user'),
            TextField::new('title'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            NumberField::new('default_size'),
            NumberField::new('default_weight'),
            AssociationField::new('default_material'),
            NumberField::new('nbr_of_printing_hours'),
        ];
    }
}
