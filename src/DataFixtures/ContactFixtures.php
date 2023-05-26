<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 50; $i++) { 
            $contact = new Contact();
            $contact->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPhoneNumber($faker->phoneNumber())
                ->setEmail($faker->email());

            $manager->persist($contact);
        }
        
        $manager->flush();
    }
}
