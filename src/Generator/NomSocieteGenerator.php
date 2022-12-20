<?php

namespace App\Generator;

class NomSocieteGenerator
{
    //  Générateur de nom de société factice

    /**
     * Générer un nom de société aléatoire
     * @param integer $caracteres - Nombre de caractères
     * @param string $Consonnes
     * @param string $Voyelles
     * @param string $pasDeuxFois
     * @param integer $sum
     * @return string $nom_societe - Nom de société aléatoire
     */

    public function NomSociete(): string
    {
        // Nombre de caractères contenu dans le nom de la société
        $caracteres = 6;

        // Consonnes et voyelles utilisées pour générer le nom
        $Consonnes = ['qu', 'b', 'c', 'd', 'f', 'g', 'h', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'v', 'w'];
        $Voyelles = ['a', 'e', 'i', 'o', 'u'];

        //lettres qu'on ne veut pas deux fois de suite
        $pasDeuxFois = ['x', 'w', 'v', 'h', 'i', 'u', 'y', 'o', 'e', 'a'];

        //on compte combien il y a de consonnes
        $NbrDeConsonnes = count($Consonnes) - 1;

        //on compte combien il y a de voyelles
        $NbrDeVoyelles = count($Voyelles) - 1;

        // On génère le nom
        //on initialise notre variable nom_societe, on viendra y rajouter caractère par caractère pour le construire
        $nom_societe = '';

        //on commence par mettre une consonne
        $mettre = 'consonne';

        //cv pour "compter voyelle" (au bout de deux voyelles maximum on repassera à consonne)
        $cv = 0;
        for ($i = 0; $i <= $caracteres - 1; $i++) {
            if ($mettre == 'consonne') {
                //on vérifie que ça ne termine pas par "qu"
                do {
                    $caractere = $Consonnes[rand(0, $NbrDeConsonnes)];

                } while ($caractere == 'qu' and ($i + 1) == $caracteres);

                //on compte deux caractères au lieu d'un pour "qu"
                if ($caractere == 'qu') $i += 1;

                //on repasse à voyelle
                $mettre = 'voyelle';

                //on choisit une consonne aléatoirement
                $nom_societe .= $caractere;

            } elseif ($mettre == 'voyelle') {
                //on vérifie si le nouveau caractère utilisé n'est pas un qui est interdit à la suite, dans $pasDeuxFois
                do {
                    $caractere = $Voyelles[rand(0, $NbrDeVoyelles)];

                } while ((substr($nom_societe, -1) == $caractere) and in_array(substr($nom_societe, -1), $pasDeuxFois));

                //c'est un caractère autorisé, on l'ajoute au nom_societe
                $nom_societe .= $caractere;

                //si on arrive à un maximum de 2 voyelles à la suite, on passe aux consonnes
                if ($cv == 2) {
                    $mettre = 'consonne';

                    //on passe à la prochaine itération (soit : une consonne)
                    continue;
                }

                //une chance sur deux de passer à consonne
                if (rand(1, 2) == 1) $mettre = 'consonne';

                //sinon on compte les voyelles pour qu'à la deuxième maximum on repasse à consonne
                $cv += 1;
            }
        }
        return $nom_societe;
    }
}