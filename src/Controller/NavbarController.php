<?php
// J'ai créé ce controleur pour essayer d'envoyer le logo depuis la bdd vers la navbar.
// Pour l'instant, ça ne fontionne pas. Je ne sais pas comment récupérer cette variable dans ma vue, vu que la navbar n'est pas une vraie vue, mais est incluse dans toutes les vues.
namespace App\Controller;

use App\Entity\Logo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    /**
     * @Route("/navbar", name="navbar")
     */
    public function index()
    {
        // On recupere les infos du logo dans la bdd
        $logo = $this->getDoctrine()->getRepository(logo::class)->findBy(array(),array('id'=>'ASC'),1,0);
        return $this->render('tatoo-kozak/components/navbar.html.twig', [
            'controller_name' => 'NavbarController',
            'logo' => $logo
            
        ]);
        // dd($logo);
    }
}
