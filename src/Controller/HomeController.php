<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{


   /**
    * @Route("/", name="home")
    */


   public function homeLoad()
   {
      return $this->render('tatoo-kozak/pages/home.html.twig', ['menu_courant' => 'home']);
   }
}
