<?php

namespace App\Service;

class GetPrice
{

    public function __construct($print, $material)
    {
        $this->print = $print;
        $this->material = $material;
    }

    static function priceProductWithMaterial($print, $material)
    {
        // Poid du print 
        $printWeight = $print[0]->getDefaultWeight();
        // prix du materiel choisi
        $priceMaterialPerKg = $material[0]->getPricePerKg();
        //Calcul du prix par gramme
        $pricePerGramme = $priceMaterialPerKg / 1000;
        //prix du print avec le bon materiel
        $priceWithNewMaterial = $printWeight * $pricePerGramme;
        return $priceWithNewMaterial;
    }

    static function priceProductWithElectricity($print)
    {
        // tarif du kwh du client en 2022
        $priceKw = 0.23;
        // Nbr d'heures d'impression
        $nbrHours = $print[0]->getNbrOfPrintingHours();
        // moyenne de consommation de 200 watt
        // moyenne de consommation en kw de l'imprimante du client
        $consommationElecPrint = 200 / 1000;
        // les kw * le nb d'heures d'impression
        $calculConso = $consommationElecPrint * $nbrHours;
        // les kwh utilisé * prix moyen du kwh
        $priceOfElectricity = $calculConso * $priceKw;
        return $priceOfElectricity;
    }

    static function priceProductFinal($calcul)
    {
        // pourcentage de rentabilité client 
        $percentage = 60;
        $resultCalculPercentage = ($percentage * $calcul) / 100;
        //prix final
        $finalPrice = round(($calcul + $resultCalculPercentage), 1);
        return $finalPrice;
    }
}
