<?php

namespace App\Controller;

use App\Entity\AProposEtInfos;
use App\Entity\Slogan;
use App\Repository\RealisationsRepository;
use App\Repository\AProposEtInfosRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
   private $realisationsRepository;

   public function __construct(RealisationsRepository $realisationsRepository, AProposEtInfosRepository $aProposEtInfosRepository)
   {
      $this->realisationsRepository = $realisationsRepository;
      $this->aProposEtInfosRepository = $aProposEtInfosRepository;
   }

   /**
    * @Route("/", name="home")
    */
   public function homeLoad()
   {
      // On recupere le slogan, avec la méthode findField créée dans le repository.
      // Elle retourne la valeur du champ en paramètres, et ne recherche que dans la première ligne de la table
      $slogan = $this->aProposEtInfosRepository->findField("slogan");


      // On récupère les 3 dernières réalisations avec une methode directement dans le repos
      $last3Realisations = $this->realisationsRepository->findLast3Realisations();
      // On envoie à la vue les différentes variables, dont le slogan, dans un tableau 
      return $this->render('tatoo-kozak/pages/home.html.twig', [
         'menu_courant' => 'home',
         'slogan' => $slogan,
         'last3Realisations' => $last3Realisations
      ]);
   }
}
