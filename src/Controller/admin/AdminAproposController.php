<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AProposEtInfos;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AProposEtInfosRepository;
use App\Form\AProposType;

class AdminAproposController extends AbstractController
{
    public function __construct(AProposEtInfosRepository $aProposEtInfosRepository, EntityManagerInterface $em)
    {

        $this->em = $em;
    }



    /**
     * @Route("/admin/apropos", name="admin_apropos")
     */
    // ======== ÉDITER A PROPOS ========
    public function edit(Request $request)
    {
        // $aProposEtInfos = new AProposEtInfos();
        $aProposEtInfos = $this->getDoctrine()->getRepository(AProposEtInfosRepository::class)->findAll();

        $form = $this->createForm(AProposType::class, $aProposEtInfos);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($aProposEtInfos);
            $this->em->flush();
            $this->addFlash('succes', 'Succès de la mise à jour');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin_apropos/index.html.twig', [
            'aproposEtInfos' => $aProposEtInfos,
            'form' => $form->createView()
        ]);
    }
}
