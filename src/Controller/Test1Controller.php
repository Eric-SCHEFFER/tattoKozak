<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test1Controller extends AbstractController
{
    /**
     * @Route("/test1", name="test1")
     */
    public function index(): Response
    {
        return $this->render('test1.html.twig', [
            'variable1' => 'variable 1',
        ]);
    }
}
