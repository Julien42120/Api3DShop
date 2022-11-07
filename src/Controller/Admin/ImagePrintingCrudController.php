<?php

namespace App\Controller\Admin;

use App\Entity\ImagePrinting;
use App\Entity\Printing;
use App\Repository\PrintingRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ImagePrintingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImagePrinting::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('printing'),
            ImageField::new('image')
                ->setBasePath('public\uploads\images_printings')
                ->setUploadDir('public\uploads\images_printings'),
        ];
    }
}
