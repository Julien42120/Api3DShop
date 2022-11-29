<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use App\Repository\PrintingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConfigurationController extends AbstractController
{
    #[Route('/get_price', name: 'price_configuration', methods: "POST")]
    public function getPriceConfiguration(Request $request, PrintingRepository $printingRepository, MaterialRepository $materialRepository): HttpFoundationResponse
    {

        $parameters = json_decode($request->getContent(), true);

        $printId = $parameters['printing'];
        $materialId = $parameters['material'];

        // Je récupère mes entité en foction de l'id reçu
        $print = $printingRepository->findBy(['id' => $printId], [],);
        $material = $materialRepository->findBy(['id' => $materialId], [],);

        // Prix du print
        $printPrice = $print[0]->getPrice();

        // Poid du print 
        $printWeight = $print[0]->getDefaultWeight();

        // prix du materiel choisi
        $priceMaterialPerKg = $material[0]->getPricePerKg();

        //Calcul du prix par 
        $pricePerGramme = $priceMaterialPerKg / 1000;

        // X 1.7 en moyenne  pour le cout de l'électricité 
        $resultCalcul = round(($printWeight * $pricePerGramme) * 1.7);

        return $this->json([
            'new_price' => $resultCalcul
        ]);
    }
}
