<?php

namespace App\Controller;

use App\Entity\ImagePrinting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Service\FileUploader;

#[AsController]
final class ImagePrintingController extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader): ImagePrinting
    {
        $uploadedFile = $request->files->get('image');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"image" is required');
        }

        // create a new entity and set its values
        $imagePrint = new ImagePrinting();
        $imagePrint->setPrinting($request->get('print'));


        $uploadName = $fileUploader->upload($uploadedFile, $this->getParameter("printings_uploads_directory"));
        // upload the file and save its filename
        $imagePrint->setImage($fileUploader->getUrl($uploadName, $this->getParameter("printings_uploads_directory")));
        return $imagePrint;
    }
}
