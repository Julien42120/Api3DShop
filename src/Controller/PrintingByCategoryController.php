<?php

namespace App\Controller;


use App\Entity\Category;
use App\Repository\PrintingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PrintingByCategoryController extends AbstractController
{
    /////////////////// OK
    #[Route('/category/{id}', name: 'printing_by_category', methods: "GET")]
    public function __invoke(PrintingRepository $printingRepository, Category $category): Response
    {
        $allPrintingsByCategory = $printingRepository->findBy(['category' => $category->getId()], [],);
        $response = [
            'success' => false,
            'category' => $allPrintingsByCategory
        ];
        return $this->json($response);
    }
}
