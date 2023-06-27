<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 500; $i++) { 
            $company = new Company();
            $company->setName($faker->company())
                    ->setCity($faker->city())
            ;

            $manager->persist($company);
            $this->addReference('company_' . $i, $company);
        }

        $manager->flush();
    }
}
