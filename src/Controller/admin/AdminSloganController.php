<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AProposEtInfosRepository;
use App\Entity\AProposEtInfos;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SloganType;
use Doctrine\ORM\EntityManagerInterface;

class AdminSloganController extends AbstractController
{
    public function __construct(AProposEtInfosRepository $aProposEtInfosRepository, EntityManagerInterface $em)
    {
        $this->aProposEtInfosRepository = $aProposEtInfosRepository;
        $this->em = $em;
    }
    /**
     * @Route("/admin/slogan", name="admin.slogan")
     */
    public function edit(Request $request)
    {
        // On récupère la table apropos_et_infos
        $slogan = $this->getDoctrine()->getRepository(AProposEtInfos::class)->findAll();
        // Comme il n'y a qu'une seule ligne, ce sera l'index 0 du tableau
        $slogan = $slogan[0];
        // dd($slogan); 
        $form = $this->createForm(SloganType::class, $slogan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($slogan);
            $this->em->flush();
            $this->addFlash('succes', 'Slogan mis à jour avec succès');
            return $this->redirectToRoute('admin');
        }


        return $this->render('admin/adminSlogan.html.twig', [
            // 'slogan' => $slogan,
            'form' => $form->createView()
        ]);
    }
}
