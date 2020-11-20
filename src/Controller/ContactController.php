<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use App\Repository\AProposEtInfosRepository;
use App\Entity\AProposEtInfos;


class ContactController extends AbstractController
{

    public function __construct(AProposEtInfosRepository $aProposEtInfosRepository)
   {
      $this->aProposEtInfosRepository = $aProposEtInfosRepository;
   }

    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer, AProposEtInfosRepository $aProposEtInfosRepository)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $expediteur = $contact['email'];
            $destinataire = $this->aProposEtInfosRepository->findField("email_envoi_formulaire");
            $destinataire = $destinataire[0]['email_envoi_formulaire'];
            $templateTwig = "emails/contact.html.twig";

            // Envoi du mail contenant les données du formulaire
            $this->envoiEmail($mailer, $expediteur, $destinataire, $templateTwig, $contact);
            $this->addFlash('succes', 'Votre message à bien été envoyé, et sera traité dans les plus brefs délais. Merci');
            return $this->redirectToRoute('home');
        }
        return $this->render('contact/index.html.twig', [
            'menu_courant' => 'contact',
            'contactForm' => $form->createView(),
        ]);
    }

    /** ======= Méhode: Envoi d'email en html, dont le corps est cherché dans une page twig ========
     *
     */
    private function envoiEmail($mailer, $expediteur, $destinataire, $templateTwig, $contact)
    {
        $email = (new TemplatedEmail())
            ->from($expediteur)
            ->to($destinataire)
            ->htmlTemplate($templateTwig)
            // Envoi les paramètres à la page twig
            ->context([
                'contact' => $contact
            ]);
        $mailer->send($email);
    }
}
