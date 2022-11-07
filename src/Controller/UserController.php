<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class UserController extends AbstractController
{
    // use UploadImageTrait;
    #[Route('/profile', name: 'app_profile')]
    public function __invoke(OrderRepository $orderRepository)
    {
        $allOrder = $orderRepository->findBy(['user' => $this->getUser()], [],);
        $user = $this->getUser();
        $response = [
            'success' => false,
            'user' => $user,
            'order' => $allOrder,

        ];
        return $this->json($response);
    }
}
