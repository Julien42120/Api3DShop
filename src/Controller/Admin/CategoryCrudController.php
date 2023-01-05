<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('category'),
            ImageField::new('image')
                ->setBasePath('public/uploads/images_categories/')
                ->setUploadDir('public/uploads/images_categories/')
                ->setUploadedFileNamePattern('https://3dshopapi.fr/public/uploads/images_categories/[slug]-[timestamp].[extension]'),
        ];
    }
}
