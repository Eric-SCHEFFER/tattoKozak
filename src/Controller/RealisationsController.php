<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RealisationsRepository;

class RealisationsController extends AbstractController
{
   private $repository;

   public function __construct(RealisationsRepository $repository)
   {
      $this->repository = $repository;
   }

   /**
    * @Route("/realisations", name="realisations")
    */


   public function realisationsLoad()
   {
      $realisations = $this->repository->findBy(array(), array('date_creation' => 'DESC'));


      return $this->render('tatoo-kozak/pages/realisations.html.twig', [
         'menu_courant' => 'realisations',
         'realisations' => $realisations
      ]); // En paramètre, menu_courant c'est une variable qui servira à styler le lien quand on est sur sa page (actif)
      // Il faut aussi rajouter une condition dans le lien du menu.
   }
}
