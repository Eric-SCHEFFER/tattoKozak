<?php

namespace App\Controller\admin;

use App\Entity\Realisations;
use App\Form\RealisationType;
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
     * @Route("/admin/realisations/edit/{id}", name="admin.realisations.edit")
     * @param Realisations $realisation
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Realisations $realisations)
    {
        $form = $this->createForm(RealisationType::class, $realisations);
        

        return $this->render('admin/realisations/edit.html.twig', [
            'realisation' => $realisations,
            'form' => $form->createView()
        ]);
    }
}
