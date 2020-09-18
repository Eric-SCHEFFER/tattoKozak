<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RealisationsRepository;

class AdminRealisationsController extends AbstractController
{
    private $repository;

    public function __construct(RealisationsRepository $repository)
    {


        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.realisation")
     */
    public function index()
    {
        $realisations = $this->repository->findAll();

        return $this->render('admin/realisations/adminRealisations.html.twig', [
            'realisations' => $realisations
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.realisation.edit")
     */
    public function edit()
    {


    }
}
