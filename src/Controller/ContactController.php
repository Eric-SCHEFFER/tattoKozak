<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            // Envoi du mail
            // dd($contact);
            $message = (new \Swift_Message('Nouveau Contact'))

                // On attribue l'expéditeur
                ->setFrom($contact['email'])

                // On attribue le destinataire
                ->setTo('adresse@toto.com')

                // On créé le msg avec la vue twig
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        compact('contact')
                    ),
                    'text/html'
                )
            ;
            // On envoie le msg
            $mailer->send($message);
            $this->addFlash('succes', 'Le message à bien été envoyé');
            return $this->redirectToRoute('home');
        }
        return $this->render('contact/index.html.twig', [
            'menu_courant' => 'contact',
            'contactForm' => $form->createView(),
        ]);
    }
}
