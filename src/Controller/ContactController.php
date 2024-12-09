<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'app_contact')]
    public function index(MailerInterface $mailer, Request $request): Response
    {
        $contact = new Contact();

        $contact_form = $this->createForm(ContactType::class, $contact);

        $contact_form->handleRequest($request);

        if ($contact_form->isSubmitted()) {

            $email = new Email();

            $emailTemplate = $this->renderView('contact/contact_send.html.twig', [
                'contact' => $contact,
            ]);

            $this->addFlash('success', 'Votre message a bien été envoyé.');

            $mailer->send($email->from('test@top.com')
                ->to('contact@top.com')
                ->subject('Une demande de contact a été faite.')
                ->html($emailTemplate));
        }

        return $this->render('contact/index.html.twig', [
            'formView' => $contact_form->createView(),
        ]);
    }



    #[Route('/contact_send/{id}', name: 'contact_send')]
    public function contactSend(int $id, EntityManagerInterface $entityManager): Response
    {
        $contact = $entityManager->getRepository(Contact::class)->find($id);


        return $this->render('contact/contact_send.html.twig', [
            'contact' => $contact,
        ]);
    }


}
