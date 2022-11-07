<?php

namespace App\Controller;


use App\Repository\PrintingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PrintingController extends AbstractController
{
    /////////////////// OK
    #[Route('/printing', name: 'all_printing', methods: "GET")]
    public function __invoke(PrintingRepository $printingRepository): Response
    {
        $allPrints = $printingRepository->findAll();
        $response = [
            'success' => false,
            'printings' => $allPrints,
        ];
        return $this->json($response);
    }
}
