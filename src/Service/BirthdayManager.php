<?php

namespace App\Service;

use App\Repository\ContactRepository;
use DateTime;

class BirthdayManager 
{
    public function __construct(
        private ContactRepository $contactRepository
    )
    {   
    }

    public function getBirthdayPeople(): array
    {
        $contacts = $this->contactRepository->findAll();
        $birthdayPeople = [];

        foreach($contacts as $contact) {
            if(
                $contact->getDateOfBirth()->format('d-m') == (new DateTime())->format('d-m')
            ) {
                $birthdayPeople[] = $contact;
            }
        }

        return $birthdayPeople;
    }

}