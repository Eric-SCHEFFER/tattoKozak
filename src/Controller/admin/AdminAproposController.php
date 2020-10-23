<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AProposEtInfos;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AProposType;

class AdminAproposController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/admin/apropos", name="admin_apropos")
     */
    // ======== ÉDITER A PROPOS ========
    public function edit(Request $request)
    {
        // On récupère la table apropos_et_infos
        $aProposEtInfos = $this->getDoctrine()->getRepository(AProposEtInfos::class)->findAll();
        // Comme il n'y a qu'une seule ligne, ce sera l'index 0 du tableau
        $aProposEtInfos = $aProposEtInfos[0];
        $form = $this->createForm(AProposType::class, $aProposEtInfos);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($aProposEtInfos);
            $this->em->flush();
            $this->addFlash('succes', 'Mis à jour avec succès');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin_apropos/index.html.twig', [
            'aproposEtInfos' => $aProposEtInfos,
            'form' => $form->createView()
        ]);
    }
}
