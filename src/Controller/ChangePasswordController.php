<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChangePasswordController extends AbstractController
{

    // public function index(): Response
    // {
    //     return $this->render('change_password/index.html.twig', []);
    // }


    /**
     * @Route("admin/changePassword", name="change_password")
     */
    public function ChangePass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 nouveaux mots de passe entrés sont identiques
            if ($request->request->get('newPassword') == $request->request->get('newPasswordConfirm')) {
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('newPassword')));
                $em->flush();
                $this->addFlash('succes', 'Mot de passe modifié avec succès');

                return $this->redirectToRoute('admin');
            } else {
                $this->addFlash('error', 'Les deux nouveaux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('change_password/index.html.twig');
    }
}
