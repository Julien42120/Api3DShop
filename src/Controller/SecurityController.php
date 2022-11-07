<?php

namespace App\Controller;

use App\Entity\User;
use App\Traits\UploadImageTrait;
use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class SecurityController extends AbstractController
{

    #[Route(path: 'login', name: 'api_login', methods: ['POST'])]
    public function apiLogin()
    {
        $user = $this->getUser();
        return $this->json([
            'roles' => $user->getRoles()
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout', methods: ['GET'])]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
