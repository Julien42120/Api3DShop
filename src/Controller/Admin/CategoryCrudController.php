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
                ->setBasePath('uploads/images_categories/')
                ->setUploadDir('public/uploads/images_categories/')
                ->setUploadedFileNamePattern('http://127.0.0.1:8000/uploads/images_categories/[slug]-[timestamp].[extension]'),
        ];
    }
}
