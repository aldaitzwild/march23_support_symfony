<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    #[Route('/group/{idGroup}/add/contact/{idContact}', name: 'app_add_contact_group')]
    public function addContactGroup(
        int $idGroup,
        int $idContact,
        GroupRepository $groupRepository, 
        ContactRepository $contactRepository): Response
    {
        $group = $groupRepository->find($idGroup);
        $contact = $contactRepository->find($idContact);

        $group->addContact($contact);

        $groupRepository->save($group, true);

        return new Response(status: 200);
    }
}
