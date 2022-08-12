<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\PrintingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrintingController extends AbstractController
{
    #[Route('/printing', name: 'app_printing')]
    public function getPrinting(PrintingRepository $printingRepository, Category $category): Response
    {
        $allPrintings = $printingRepository->findBy(['category' => $category->getId()], [],);
        $response = [
            'success' => false,
            'categories' => $allPrintings,
        ];
        return $this->json($response);
    }
}
