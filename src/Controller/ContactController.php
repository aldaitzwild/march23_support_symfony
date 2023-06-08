<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contactList', name: 'app_contact_list')]
    public function index(GroupRepository $groupRepository): Response
    {
        $groups = $groupRepository->findAll();

        return $this->render('contact/index.html.twig', [
            'groups' => $groups
        ]);
    }

    #[Route('/contact/{id<\d+>}', name: 'app_contact_show')]
    public function show(Contact $contact, GroupRepository $groupRepository): Response
    {
        $groups = $groupRepository->findAll();

        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
            'groups' => $groups
        ]);
    }

    #[Route('/contact/new', name: 'app_contact_create')]
    public function create(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);
            return $this->redirectToRoute('app_contact_list');
        }
        

        return $this->render('contact/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/contact/delete/{id<\d+>}', name: 'app_contact_delete', methods: ['POST'])]
    public function delete(Contact $contact, Request $request, ContactRepository $contactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $contactRepository->remove($contact, true);
        }
        return $this->redirectToRoute('app_contact_list');
    }

}
