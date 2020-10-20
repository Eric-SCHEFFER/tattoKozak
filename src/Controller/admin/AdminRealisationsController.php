<?php

namespace App\Controller\admin;

use App\Entity\Images;
use App\Entity\Realisations;
use App\Form\RealisationType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RealisationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Gedmo\Sluggable\Util\Urlizer;


class AdminRealisationsController extends AbstractController
{
    private $repository;
    private $images;

    public function __construct(RealisationsRepository $repository, ImagesRepository $imagesRepository, EntityManagerInterface $em)
    {
        $this->imagesRepository = $imagesRepository;
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/realisations", name="admin.realisation", methods={"GET"})
     */
    public function index()
    {
        $realisations = $this->repository->findBy(array(), array('updated_at' => 'DESC'));

        return $this->render('admin/realisations/adminRealisations.html.twig', [
            'realisations' => $realisations
        ]);
    }




    // ======== CRÉER RÉALISATION ========
    /**
     * @Route("/admin/realisation/creation", name="admin.realisation.new")
     */
    public function new(Request $request)
    {
        $realisation = new Realisations();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $images = $form->get('imageFile')->getData();
            // On boucle sur les images
            foreach ($images as $image) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('dossier_images'),
                    $fichier
                );
                // On stocke le nom de l'image dans la base de données
                $img = new Images();
                $img->setLien($fichier);
                $realisation->addImage($img);
            }

            $this->em->persist($realisation);
            $this->em->flush();
            $this->addFlash('succes', 'Réalisation crée avec succès');
            return $this->redirectToRoute('admin.realisation');
        }
        return $this->render('admin/realisations/nouvelle.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView()
        ]);
    }




    // ======== ÉDITER RÉALISATION ========
    /**
     * @Route("/admin/realisations/edit/{id}", name="admin.realisations.edit", methods="GET|POST")
     * @param Realisations $realisation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Realisations $realisation, Request $request)
    {
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $images = $form->get('imageFile')->getData();
            // On boucle sur les images
            foreach ($images as $image) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uplaods
                $image->move(
                    $this->getParameter('dossier_images'),
                    $fichier
                );
                // On stocke le nom de l'image dans la base de données
                $img = new Images();
                $img->setLien($fichier);
                $realisation->addImage($img);
            }
            $this->em->persist($realisation);
            $this->em->flush();
            // Je rajoute le titre de la réalisation dans le flashMessage
            $this->addFlash('succes', '"' . $realisation->getTitre() . '"' . ' mis à jour avec succès');
            return $this->redirectToRoute('admin.realisation');
        }
        return $this->render('admin/realisations/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView()
        ]);
    }




    // ======== SUPPRIMER RÉALISATION ========
    /**
     * @Route("/admin/realisations/edit/{id}", name="admin.realisations.delete", methods={"DELETE"})
     * @param Realisations $realisation
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Realisations $realisation, Request $request)
    {
        // Vérif token pour sécuriser la suppression d'une réalisation
        if ($this->isCsrfTokenValid('delete' . $realisation->getId(), $request->get('_token'))) {

            // Rechercher dans Images toutes les images de la réalisation en cours
            $images = $this->getDoctrine()->getRepository(Images::class)->findBy(
                ['realisations_id' => $realisation->getId()]
            );
            // On récupére dans une boucle le nom de chaque image, et on la supprime sur le disque
            foreach ($images as $image) {
                $nom = $image->getLien();
                unlink($this->getParameter('dossier_images') . '/' . $nom);
            }
            // On supprime la réalisation, ainsi que toutes ses images (Option orphanRemoval) dans la base 
            $this->em->remove($realisation);
            $this->em->flush();
            $this->addFlash('succes', '"' . $realisation->getTitre() . '"' . ' supprimé avec succès');
            //return new HttpFoundationResponse('Suppression');
        }
        return $this->redirectToRoute('admin.realisation');
    }


    // ======== SUPPRIMER UNE IMAGE ========
    /**
     * @route("/admin/realisations/image/supprime{id}", name="admin.realisations.image.delete", methods={"DELETE"})
     */
    public function deleteImage(Images $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        // On vérifie si le token est valide
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            // On récupère le nom de l'image (le champ "lien" n'est peut-être pas un bon nom, j'en suis conscient)
            $nom = $image->getLien();
            // On supprime le fichier
            unlink($this->getParameter('dossier_images') . '/' . $nom);
            // On supprime le nom de l'image de la base de données
            $this->em->remove($image);
            $this->em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
