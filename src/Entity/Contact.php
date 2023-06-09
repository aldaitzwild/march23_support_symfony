<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\NotBlank(message: 'Le numéro de téléphone doit etre renseigné.')]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(message: 'L\'email renseigné doit respecter le format Email')]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Group::class, mappedBy: 'contacts')]
    private Collection $contactGroups;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoFileName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    private ?Company $company = null;

    public function __construct()
    {
        $this->contactGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getContactGroups(): Collection
    {
        return $this->contactGroups;
    }

    public function addContactGroup(Group $contactGroup): self
    {
        if (!$this->contactGroups->contains($contactGroup)) {
            $this->contactGroups->add($contactGroup);
            $contactGroup->addContact($this);
        }

        return $this;
    }

    public function removeContactGroup(Group $contactGroup): self
    {
        if ($this->contactGroups->removeElement($contactGroup)) {
            $contactGroup->removeContact($this);
        }

        return $this;
    }

    public function getPhotoFileName(): ?string
    {
        return $this->photoFileName;
    }

    public function setPhotoFileName(?string $photoFileName): self
    {
        $this->photoFileName = $photoFileName;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
