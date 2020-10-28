<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AProposEtInfosRepository;

class MentionsLegalesController extends AbstractController
{
    public function __construct(AProposEtInfosRepository $aProposEtInfosRepository)
    {
        $this->aProposEtInfosRepository = $aProposEtInfosRepository;
    }
    /**
     * @Route("/mentions_legales", name="mentions_legales")
     */
    public function index()
    {
        // On recupere les mentions légales, avec la méthode findField créée dans le repository.
        // Elle retourne la valeur du champ en paramètres, et ne recherche que dans la première ligne de la table
        $mentionsLegales = $this->aProposEtInfosRepository->findField("mentions_legales");

        return $this->render('mentions_legales/index.html.twig', [
            'mentionsLegales' => $mentionsLegales,
        ]);
    }
}
