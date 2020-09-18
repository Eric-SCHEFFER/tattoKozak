<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminRealisationsController extends AbstractController
{
    /**
     * @Route("/admin/realisations", name="admin_realisations")
     */
    public function index()
    {
        return $this->render('admin_realisations/index.html.twig', [
            'controller_name' => 'AdminRealisationsController',
        ]);
    }
}
