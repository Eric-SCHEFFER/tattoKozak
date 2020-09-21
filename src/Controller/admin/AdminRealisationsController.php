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
     * @Route("/admin/realisation/edit/{id}", name="admin.realisation.edit")
     * @param Realisation $realisation
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Realisation $realisation)
    {
        return $this->render('admin/realisations/edit.html.twig', [
            'realisation' => $realisation
        ]);
    }
}
