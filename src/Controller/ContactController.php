<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contactList', name: 'app_contact_list')]
    public function index(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findAll();

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts
        ]);
    }

    #[Route('/contact/{id<\d+>}', name: 'app_contact_show')]
    public function show(Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact
        ]);
    }

    #[Route('/contact/new', name: 'app_contact_create')]
    public function create(): Response
    {
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact);
        return $this->render('contact/new.html.twig', [
            'form' => $form
        ]);
    }

}
