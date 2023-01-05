<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


use App\Service\FileUploader;

#[AsController]
final class CategoryImageController extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader): Category
    {
        $uploadedFile = $request->files->get('image');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"image" is required');
        }

        // create a new entity and set its values
        $category = new Category();
        $category->setCategory($request->get('category'));


        $uploadName = $fileUploader->upload($uploadedFile, $this->getParameter("categorys_uploads_directory"));
        // upload the file and save its filename
        $category->setImage($fileUploader->getUrl($uploadName, $this->getParameter("categorys_uploads_directory")));
        return $category;
    }
}
