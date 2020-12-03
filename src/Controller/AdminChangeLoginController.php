<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class AdminChangeLoginController extends AbstractController
{
    /** ======== Envoi de la requête de changement d'email de connexion, via le lien de validation par email ========
     * @Route("/admin/changeLogin", name="change_login")
     */
    public function resetAuthenticationEmailRequest(MailerInterface $mailer, Request $request, UserPasswordEncoderInterface $passwordEncoder)
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
                $this->addFlash('error', 'Le mot de passe n\'est pas valide');
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

            // Si on a au moins une erreur, on retourne la vue de changement d'email, avec les messages d'erreurs
            if ($err) {
                return $this->render('admin_change_login/index.html.twig');
            }

            // Si pas d'erreur
            else {
                // On créé le token de reset de l'email
                $token = md5(uniqid());
                $user->setResetEmailToken($token);
                // l'email candidat
                $user->setEmailCandidat($nouvEmail);
                // On sauvegarde dans la base
                $em->persist($user);
                $em->flush();

                // On envoie un email contenant le lien de validation de l'email candidat
                $expediteur = "siteTattooKozak@toto.com";
                $destinataire = $nouvEmail;
                $objet = "Validation email de connexion";
                $templateTwig = "admin_change_login/envoiMailLienValidation.html.twig";
                $this->envoiEmail($mailer, $expediteur, $destinataire, $objet, $templateTwig, $token);
                // On ajoute dans un message flash le succès d'envoi de l'email, et on redirige vers la page d'accueil
                $this->addFlash('succes', 'Nous venons de vous envoyer un lien de validation à l\'adresse: ' . $nouvEmail . '. Si vous n\'êtes plus connecté quand vous cliquez sur le lien, vous devrez vous reconnecter avec l\'identifiant actuel ' . $user->getEmail());
                return $this->redirectToRoute('admin');
            }
        }
        return $this->render('admin_change_login/index.html.twig');
    }



    /** ======== Récupère le clic du lien de validation de l'email, et sauvegarde l'email candidat dans la base ========
     * @Route("admin/activerEmailCandidat/{token}", name="activer_email_candidat")
     */
    public function activerEmailCandidatConnexion($token, UserRepository $userRepo)
    {
        $em = $this->getDoctrine()->getManager();
        // On vérifie si un utilisateur a ce token
        $user = $userRepo->findOneBy(['reset_email_token' => $token]);
        // Si aucun utilisateur n'existe avec ce token
        if (!$user) {
            // Erreur 404
            throw $this->createNotFoundException('Le token n\'existe pas dans la base');
        }
        // On copie emailCandidat dans email
        $user->setEmail($user->getEmailCandidat());
        // On supprime l'emailCandidat
        $user->setEmailcandidat(NULL);
        // on supprime le token
        $user->setResetEmailToken(NULL);
        $em->persist($user);
        $em->flush();
        $this->addFlash('succes', 'L\'identifiant de connexion a été modifié avec succès: ' . $user->getEmail());
        return $this->redirectToRoute('admin');
    }


    /** ======= Envoie l'email en html, dont le corps est cherché dans une page twig ========
     *
     */
    private function envoiEmail($mailer, $expediteur, $destinataire, $objet, $templateTwig, $token)
    {
        $email = (new TemplatedEmail())
            ->from($expediteur)
            ->to($destinataire)
            ->subject($objet)
            ->htmlTemplate($templateTwig)
            ->context([
                'token' => $token
            ]);
        $mailer->send($email);
    }
}
