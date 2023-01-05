<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use App\Entity\User;
use App\Service\FileUploader;

#[AsController]
final class UserAvatarController extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader): User
    {
        $uploadedFile = $request->files->get('avatar');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"avatar" is required');
        }
 
        // create a new entity and set its values
        $user = new User();
        $user->setPseudo($request->get('pseudo'));
        $user->setEmail($request->get('email'));
        $user->setPhone($request->get('phone'));
        $user->setPlainPassword($request->get('password'));

        $uploadName = $fileUploader->upload($uploadedFile, $this->getParameter("users_uploads_directory"));
        // upload the file and save its filename
        $user->setAvatar($fileUploader->getUrl($uploadName, $this->getParameter("users_uploads_directory")));
        return $user;
    }
}
