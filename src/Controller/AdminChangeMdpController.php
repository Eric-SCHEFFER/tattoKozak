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



class AdminChangeMdpController extends AbstractController
{
    /**
     * @Route("admin/changePassword", name="change_password")
     */
    public function ChangePass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $err = false;

            // ======== Série de tests de validité des mots de passe entrés ========

            $motDePasseAVerifier = $request->request->get('actuPassword');
            $passValide = $passwordEncoder->isPasswordValid($user, $motDePasseAVerifier);
            // Si le mot de passe actuel entré n'est pas correct
            if (!$passValide) {
                $this->addFlash('error', 'Le mot de passe actuel n\'est pas valide');
                $err = true;
            }
            // Si les 2 nouveaux mots de passe entrés ne sont pas identiques
            if ($request->request->get('newPassword') !== $request->request->get('newPasswordConfirm')) {
                $this->addFlash('error', 'Les deux nouveaux mots de passe ne sont pas identiques');
                $err = true;
            }
            // TODO:
            // Si le nouveau mdp ne contient pas au moins une minuscule
            // code...
            // Si le nouveau mot de passe ne contient pas au moins une majuscule
            // code...
            // Si le nouveau mot de passe ne contient pas au moins un chiffre
            // code...
            // Si le nouveau mot de passe ne contient pas au moins l'un des caractères spéciaux: & ) = ( ?
            // code...


            // ======== En cas d'erreur, on revient vers la page de changement de mot de passe, avec les messages d'erreurs ========
            if ($err) {
                return $this->render('change_password/index.html.twig');
            }

            // ======== Si tout est bon, on enregistre le nouveau mot de passe dans la base ========
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
