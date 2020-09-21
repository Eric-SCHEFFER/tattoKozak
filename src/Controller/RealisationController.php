<?php

namespace App\Controller;

use App\Entity\Realisations;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RealisationController extends AbstractController
{


   /**
    * @Route("/realisation/{id}", name="realisation")
    */

   public function realisationLoad($id)
   {
      $repo = $this->getDoctrine()->getRepository(Realisations::class);
      $realisation = $repo->find($id);
      return $this->render('tatoo-kozak/pages/realisation.html.twig', [
         'realisation' => $realisation

      ]);
   }
}
