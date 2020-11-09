<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminChangeLoginController extends AbstractController
{
    /**
     * @Route("/admin/changeLogin", name="change_login")
     */
    public function index(): Response
    {
        return $this->render('admin_change_login/index.html.twig', [
            'controller_name' => 'AdminChangeLoginController',
        ]);
    }
}
