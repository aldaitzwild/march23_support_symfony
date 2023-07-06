<?php

namespace App\Twig\Components;

use App\Repository\ContactRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('search_contact')]
final class SearchContactComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?string $searchBar = null;

    public function __construct(
        public ContactRepository $contactRepository
    )
    {
    }

    public function getContacts(): array
    {
        if(empty($this->searchBar)) return [];
        
        return $this->contactRepository->findBySearch($this->searchBar);
    }
}
