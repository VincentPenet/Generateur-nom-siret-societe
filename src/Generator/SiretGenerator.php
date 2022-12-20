<?php

namespace App\Generator;

class SiretGenerator
{
    /* Générer un numéro aléatoire puis vérifier s'il s'agit d'un numéro SIRET valide.
    * Le principe consiste à générer les 8 premiers nombres de façon complétement
    * aléatoire et d'en calculer la "somme" (selon le principe évoqué au-dessus).
    * Puis on ajoute des zero pour combler l'espace jusqu'à ajouter la clé de vérification.
    * La clé est créée pour que la somme de (2 x le premier chiffre) + (1 x le second) soit égal à ce qu'il nous manque pour être congru à 10.
    * On retourne le numéro de façon lisible, par exemple : 774 082 010 00034.
    */

    /**
     * Générer un numéro de Siret en aléatoire
     * @param string $siret
     * @param integer $sum
     * @return string $siret - Un numéro de Siret formaté pour un affichage format "siret" standard
     */

    function siret(): string
    {
        //On génère aléatoirement un début de numéro de siret
        $siret = '';
        $sum = 0;
        for ($i = 0; $i != 8; $i++) {
            $rand = mt_rand(0, 9);
            $siret .= $rand;

            //On ajoute une fois le résultat si l'index est impair, deux fois sinon
            $tmp = $rand * (1 + ($i + 1) % 2);
            if ($tmp >= 10) $tmp -= 9;
            $sum += $tmp;
        }

        //On ajoute 4 zéros
        $siret .= "0000";

        //On regarde combien il manque pour être congru à 10
        $diff = 10 - ($sum % 10);
        if ($diff > 2) {
            $first = floor($diff / 3);
            $second = $diff - (2 * $first);
            $siret .= $first . $second;
        } else {
            $siret .= '0' . $diff;
        }
        //  On met en forme l'affichage sous un format de 4 paquets de chiffres suivi d'un espace
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{5})/", "$1 $2 $3 $4", $siret);
    }
}