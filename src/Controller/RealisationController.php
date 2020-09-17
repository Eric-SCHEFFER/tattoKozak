<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RealisationController extends AbstractController
{


   /**
    * @Route("/{id}", name="realisation")
    */

   public function realisationLoad()
   {
      return $this->render('tatoo-kozak/pages/realisation.html.twig');
   }
}
