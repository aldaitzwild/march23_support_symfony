<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $groups = [
            $this->getReference('group_family'),
            $this->getReference('group_friends'),
            $this->getReference('group_work'),
        ];

        for ($i=0; $i < 50; $i++) { 
            $contact = new Contact();
            $contact->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPhoneNumber($faker->phoneNumber())
                ->setEmail($faker->email());

            $chosenGroups = $faker->randomElements($groups, rand(1, 2));
            foreach($chosenGroups as $group) {
                $contact->addContactGroup($group);
            }
            
            $manager->persist($contact);
        }
        
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GroupFixtures::class
        ];
    }
}
