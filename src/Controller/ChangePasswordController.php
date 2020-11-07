<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
// use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
// use App\Entity\User;



class ChangePasswordController extends AbstractController
{

    // public function index(): Response
    // {
    //     return $this->render('change_password/index.html.twig', []);
    // }


    /**
     * @Route("admin/changePassword", name="change_password")
     */
    // public function ChangePass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    // {
    //     if ($request->isMethod('POST')) {
    //         $em = $this->getDoctrine()->getManager();
    //         $user = $this->getUser();

    //         // On vérifie si les 2 nouveaux mots de passe entrés sont identiques
    //         if ($request->request->get('newPassword') == $request->request->get('newPasswordConfirm')) {
    //             $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('newPassword')));
    //             $em->flush();
    //             $this->addFlash('succes', 'Mot de passe modifié avec succès');

    //             return $this->redirectToRoute('admin');
    //         } else {
    //             $this->addFlash('error', 'Les deux nouveaux mots de passe ne sont pas identiques');
    //         }
    //     }

    //     return $this->render('change_password/index.html.twig');
    // }



    /**
     * @Route("admin/changePassword", name="change_password")
     */
    public function ChangePass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $err = false;

            $motDePasseAVerifier = $request->request->get('actuPassword');
            $passValide = $passwordEncoder->isPasswordValid($user, $motDePasseAVerifier);
            // On vérifie si le mot de passe actuel entré est correct
            if (!$passValide) {
                $this->addFlash('error', 'Le mot de passe actuel n\'est pas valide');
                $err = true;
            }
            // On vérifie si les 2 nouveaux mots de passe entrés sont identiques
            if ($request->request->get('newPassword') !== $request->request->get('newPasswordConfirm')) {
                $this->addFlash('error', 'Les deux nouveaux mots de passe ne sont pas identiques');
                $err = true;
            }
            // En cas d'erreur, on revient vers la page de changement de mot de passe, avec les messages d'erreurs
            if ($err) {
                return $this->render('change_password/index.html.twig');
            }
            // Si tout est bon, on enregistre le nouveau mot de passe dans la base
            else {
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('newPassword')));
                $em->flush();
                $this->addFlash('succes', 'Mot de passe modifié avec succès');
                return $this->redirectToRoute('admin');
            }
        }
        return $this->render('change_password/index.html.twig');
    }
}
