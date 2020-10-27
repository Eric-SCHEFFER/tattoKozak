<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AProposEtInfosRepository;
use App\Entity\AProposEtInfos;

class AProposController extends AbstractController
{
    public function __construct(AProposEtInfosRepository $aProposEtInfosRepository)
    {
        $this->aProposEtInfosRepository = $aProposEtInfosRepository;
    }

    /**
     * @Route("/apropos", name="a_propos")
     */
    public function index()
    {
        $aPropos = $this->aProposEtInfosRepository->findAll();
        return $this->render('a_propos/index.html.twig', [
            'aPropos' => $aPropos
        ]);
    }
}
