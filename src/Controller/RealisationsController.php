<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RealisationsController extends AbstractController
{


   /**
    * @Route("/realisations", name="realisations")
    */


   public function realisationsLoad()
   {
      return $this->render('tatoo-kozak/pages/realisations.html.twig', ['menu_courant' => 'realisations']); // En paramètre, c'est une variable qui servira à styler le lien quand on est sur sa page (actif)
      // Il faut aussi rajouter une condition dans le lien du menu.
   }
}
