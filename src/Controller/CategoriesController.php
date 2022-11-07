<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories', methods: "GET")]
    public function __invoke(CategoryRepository $categoryRepository): Response
    {
        $allCategories = $categoryRepository->findAll();

        $response = [
            'success' => false,
            'categories' => $allCategories,
        ];
        return $this->json($response);
    }
}
