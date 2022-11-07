<?php

namespace App\Controller;

use App\Entity\Printing;
use App\Repository\ImagePrintingRepository;
use App\Repository\PrintingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PrintingByIdController extends AbstractController
{
    /////////////////// OK
    #[Route('/printing/{id}', name: 'printing_by_id', methods: "GET")]
    public function __invoke(PrintingRepository $printingRepository, Printing $print, ImagePrintingRepository $imagePrintingRepository): Response
    {
        $printingById = $printingRepository->findBy(['id' => $print->getId()], [],);
        $imagePrint = $imagePrintingRepository->findBy(['printing' => $print->getId()]);
        $response = [
            'success' => false,
            'print' => $printingById,
            'images' => $imagePrint

        ];
        return $this->json($response);
    }
}
