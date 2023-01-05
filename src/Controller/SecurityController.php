<?php

namespace App\Controller;

use App\Entity\User;
use App\Traits\UploadImageTrait;
use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

#[AsController]
class SecurityController extends AbstractController
{

    #[Route(path: 'apilogin', name: 'api_login', methods: ['POST'])]
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


    #[Route(path: 'login', name: 'app_login')]

    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
