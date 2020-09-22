<?php

namespace App\Controller\admin;

use App\Entity\Realisations;
use App\Form\RealisationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RealisationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminRealisationsController extends AbstractController
{
    private $repository;

    public function __construct(RealisationsRepository $repository, EntityManagerInterface $em)
    {


        $this->repository = $repository;
        $this->em = $em;
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
     * @Route("/admin/realisation/creation", name="admin.realisation.new")
     */
    public function new(Request $request)
    {
        $realisations = new Realisations();
        $form = $this->createForm(RealisationType::class, $realisations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($realisations);
            $this->em->flush();
            return $this->redirectToRoute('admin.realisation');
        }
        return $this->render('admin/realisations/nouvelle.html.twig', [
            'realisation' => $realisations,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/realisations/edit/{id}", name="admin.realisations.edit")
     * @param Realisations $realisation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Realisations $realisations, Request $request)
    {
        $form = $this->createForm(RealisationType::class, $realisations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.realisation');
        }
        return $this->render('admin/realisations/edit.html.twig', [
            'realisation' => $realisations,
            'form' => $form->createView()
        ]);
    }
}
