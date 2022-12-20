<?php

namespace App\Controller;

use App\Generator\NomSocieteGenerator;
use App\Generator\SiretGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenerateurSiretController extends AbstractController
{
    /**
     * @Route("/generateur_siret", name="societe_siret")
     *
     * Générer un nom de société aléatoire
     * @param string $nom_societe
     * @param string $siret
     * @return string $nom_societe - Nom de société aléatoire
     *
     * Générer un numéro de Siret en aléatoire
     * @return string $siret - Un numéro de Siret formaté pour un affichage format "siret" standard
     */

    public function index(NomSocieteGenerator $nom_societe, SiretGenerator $siret): Response
    {
        $nom_societe = $nom_societe->NomSociete();

        $siret = $siret->siret();

        return $this->render('generateur_siret/index.html.twig', [
            'nom_societe' => $nom_societe,
            'siret' => $siret,
        ]);
    }
}