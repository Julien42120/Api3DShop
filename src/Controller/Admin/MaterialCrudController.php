<?php

namespace App\Controller\Admin;

use App\Entity\Material;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaterialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Material::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type_name'),
            NumberField::new('lenght'),
            NumberField::new('density'),
            NumberField::new('price_per_kg'),
            TextField::new('color'),
            ImageField::new('image')
<<<<<<< HEAD
                ->setBasePath('public/uploads/images_materials/')
                ->setUploadDir('public/uploads/images_materials/')
                ->setUploadedFileNamePattern('https://3dshopapi.fr/public/uploads/images_materials/[slug]-[timestamp].[extension]'),
=======
                ->setBasePath('uploads/images_materials/')
                ->setUploadDir('public/uploads/images_materials/')
                ->setUploadedFileNamePattern('http://127.0.0.1:8000/uploads/images_materials/[slug]-[timestamp].[extension]'),
>>>>>>> bdd13e7b8126fa97572a95bc97e63690f3b847d4
        ];
    }
}
