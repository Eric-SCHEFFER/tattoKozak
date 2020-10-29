<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AProposEtInfosRepository;
use App\Entity\AProposEtInfos;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MentionsLegalesType;
use Doctrine\ORM\EntityManagerInterface;

class AdminMentionsLegalesController extends AbstractController
{
    public function __construct(AProposEtInfosRepository $aProposEtInfosRepository, EntityManagerInterface $em)
    {
        $this->aProposEtInfosRepository = $aProposEtInfosRepository;
        $this->em = $em;
    }
    /**
     * @Route("/admin/mentionsLlegales", name="admin_mentions_legales")
     */
    public function edit(Request $request)
    {
        // On récupère la table apropos_et_infos
        $mentionsLegales1 = $this->getDoctrine()->getRepository(AProposEtInfos::class)->findAll();
        // Comme il n'y a qu'une seule ligne, ce sera l'index 0 du tableau
        // dd($mentionsLegales);
        $mentionsLegales1 = $mentionsLegales1[0];
        $form = $this->createForm(MentionsLegalesType::class, $mentionsLegales1);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($mentionsLegales1);
            $this->em->flush();
            $this->addFlash('succes', 'Mis à jour avec succès');
            return $this->redirectToRoute('admin');
        }


        return $this->render('admin_mentions_legales/index.html.twig', [
            'mentionsLegales1' => $mentionsLegales1,
            'form' => $form->createView()
        ]);
    }
}
