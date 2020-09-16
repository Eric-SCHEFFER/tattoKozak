<?php

namespace App\Controller;

use App\Entity\Slogan;
use App\Repository\RealisationsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
   private $realisationsRepository;

   public function __construct(RealisationsRepository $realisationsRepository)
   {
      $this->realisationsRepository = $realisationsRepository;
   }


   /**
    * @Route("/", name="home")
    */


   public function homeLoad()
   {
      // On recupere le slogan depuis le SloganRepository avec la methode find (voir les autres: findAll, findOneBy, etc...)
      $slogan = $this->getDoctrine()->getRepository(Slogan::class)->findBy(array(), array('id' => 'ASC'), 1, 0);

      // On récupère les 3 dernières réalisations avec une methode directement dans le repos
      // $last3Realisations = $this->realisationsRepository->findLast3Realisations();

      $last3Realisations = $this->realisationsRepository->findLast3Realisations();






      // On envoie à la vue les différentes variables, dont le slogan, dans un tableau 
      return $this->render('tatoo-kozak/pages/home.html.twig', [
         'menu_courant' => 'home',
         'slogan' => $slogan,
         'last3Realisations' => $last3Realisations
      ]);
   }
}
