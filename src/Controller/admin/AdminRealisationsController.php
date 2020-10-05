<?php

namespace App\Controller\admin;

use App\Entity\Realisations;
use App\Form\RealisationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RealisationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Gedmo\Sluggable\Util\Urlizer;


class AdminRealisationsController extends AbstractController
{
    private $repository;

    public function __construct(RealisationsRepository $repository, EntityManagerInterface $em)
    {


        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/realisations", name="admin.realisation")
     */
    public function index()
    {
        $realisations = $this->repository->findBy(array(), array('date_creation' => 'DESC'));

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
            $this->addFlash('succes', 'Réalisation crée avec succès');
            return $this->redirectToRoute('admin.realisation');
        }
        return $this->render('admin/realisations/nouvelle.html.twig', [
            'realisation' => $realisations,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/realisations/edit/{id}", name="admin.realisations.edit", methods="GET|POST")
     * @param Realisations $realisation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Realisations $realisations, Request $request)
    {
        $form = $this->createForm(RealisationType::class, $realisations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère le fichier image
            


            $this->em->flush();
            // Je rajoute le titre de la réalisation dans le flashMessage
            $this->addFlash('succes', '"' . $realisations->getTitre() . '"' . ' mis à jour avec succès');
            return $this->redirectToRoute('admin.realisation');
        }
        return $this->render('admin/realisations/edit.html.twig', [
            'realisation' => $realisations,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/realisations/edit/{id}", name="admin.realisations.delete", methods="DELETE")
     * @param Realisations $realisation
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Realisations $realisations, Request $request)
    {
        // TODO: Vérif token pour sécuriser la suppression d'une réalisation (pour l'instant, marche pas, erreur "csrf token invalid method override")
        // if ($this->isCsrfTokenValid('delete' . $realisations->getId(), $request->get('_token'))) {
        $this->em->remove($realisations);
        $this->em->flush();
        $this->addFlash('succes', '"' . $realisations->getTitre() . '"' . ' supprimé avec succès');
        //return new HttpFoundationResponse('Suppression');
        // }
        return $this->redirectToRoute('admin.realisation');
    }
}
