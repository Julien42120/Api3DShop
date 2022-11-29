<?php

namespace App\Controller\Admin;

use App\Entity\ImagePrinting;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ImagePrintingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImagePrinting::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('printing'),
            ImageField::new('image')
                ->setBasePath('public\uploads\images_printings')
                ->setUploadDir('public\uploads\images_printings')
                ->setUploadedFileNamePattern('http://127.0.0.1:8000/uploads/images_printings/[slug]-[timestamp].[extension]'),
        ];
    }
}
