<?php

namespace App\Controller;
use App\Entity\Slogan;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{


   /**
    * @Route("/", name="home")
    */


   public function homeLoad()
   {
      // On recupere le slogan depuis le SloganRepository avec la methode find (voir les autres: findAll, findOneBy, etc...)
      $slogan = $this->getDoctrine()->getRepository(slogan::class)->find(1);
      
      // On envoie à la vue les différentes variables, dont le slogan, dans un tableau 
      return $this->render('tatoo-kozak/pages/home.html.twig', [
         'menu_courant' => 'home',
         'slogan' => $slogan,
         ]);
   }
}
