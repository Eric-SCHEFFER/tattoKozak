<?php

namespace App\Controller;

use App\Entity\Realisations;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ImagesRepository;


class RealisationController extends AbstractController
{
   // public function __construct(ImagesRepository $ImagesRepository)
   // {
   //    $this->ImagesRepository = $ImagesRepository;
   // }


   /**
    * @Route("/realisation/{id}", name="realisation")
    */

   public function realisationLoad($id, ImagesRepository $ImagesRepository)
   {
      $repo = $this->getDoctrine()->getRepository(Realisations::class);
      $realisation = $repo->find($id);

      // On recherche les images de l'Entity Images, associées à chaque réalisation
      $images = $ImagesRepository->findBy(['realisations_id'=>$realisation]);
      // dd($images);
      return $this->render('tatoo-kozak/pages/realisation.html.twig', [
         'realisation' => $realisation,
         'images'=> $images

      ]);
   }
}
