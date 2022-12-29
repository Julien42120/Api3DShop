<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use App\Repository\PrintingRepository;
use App\Service\GetPrice;
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

        // Je récupère mes entité en fonction de l'id reçu
        $print = $printingRepository->findBy(['id' => $printId], [],);
        $material = $materialRepository->findBy(['id' => $materialId], [],);

        //////////////////////////////////////////////////// 

        $priceWithNewMaterial = GetPrice::priceProductWithMaterial($print, $material);
        $priceOfElectricity = GetPrice::priceProductWithElectricity($print);

        // addition du prix du matriel + prix electicité
        $calcul = $priceOfElectricity + $priceWithNewMaterial;

        $finalPrice = GetPrice::priceProductFinal($calcul);

        return $this->json([
            'new_price' => $finalPrice
        ]);
    }
}
