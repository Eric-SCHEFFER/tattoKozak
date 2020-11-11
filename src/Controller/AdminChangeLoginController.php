<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class AdminChangeLoginController extends AbstractController
{
    // /**
    //  * @Route("/admin/changeLogin", name="change_login")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('admin_change_login/index.html.twig', [
    //         'controller_name' => 'AdminChangeLoginController',
    //     ]);
    // }


    /**
     * @Route("/admin/changeLogin", name="change_login")
     */
    public function resetAuthenticationEmail(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $err = false;
            $motDePasseAVerifier = $request->request->get('password');
            $nouvEmail = $request->request->get('newEmail');
            $nouvEmailConfirm = $request->request->get('newEmailconfirm');
            $passValide = $passwordEncoder->isPasswordValid($user, $motDePasseAVerifier);

            // On vérifie si le mot de passe actuel entré est correct
            if (!$passValide) {
                $this->addFlash('error', 'Le mot de passe actuel n\'est pas valide');
                $err = true;
            }
            // On vérifie si les 2 emails entrés correspondent
            if ($nouvEmail !== $nouvEmailConfirm) {
                $this->addFlash('error', 'Les deux emails ne sont pas identiques');
                $err = true;
            }
            // On vérifie que le nouvel email n'est pas le même que l'email actuellement en base
            elseif ($nouvEmail == $user->getEmail()) {
                $this->addFlash('error', 'Le nouvel email est le même que l\'email actuel');
                $err = true;
            }

            // Si on a au moins une erreur, on retourne tout vers la vue de changement d'email, avec les messages d'erreurs
            if ($err) {
                return $this->render('admin_change_login/index.html.twig');
            }

            // Si pas d'erreur
            else {
                // On créé le token de reset de l'email
                $user->setResetEmailToken(md5(uniqid()));
                // l'email candidat
                $user->setEmailCandidat($nouvEmail);
                // On sauvegarde dans la base
                $em->persist($user);
                $em->flush();

                // TODO
                // On envoie un email contenant le lien de validation de l'email candidat

                // On affiche la vue notifiant l'envoi de l'email
                return $this->render('admin_change_login/notificationEnvoiEmail.html.twig', [
                    'emailCandidat' => $nouvEmail
                ]);
            }
        }
        return $this->render('admin_change_login/index.html.twig');
    }

    /**
     * @Route("/admin/validationEmail/{token}", name="validation_email")
     */
    public function validerEmailconnexion()
    {

    }

    /**
     * @Route("/email")
     */
    private function envoiEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        return $this->render('tatoo-kozak/pages/testEnvoiEmail.html.twig');
        
    }
}
