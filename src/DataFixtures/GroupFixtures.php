<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $family = new Group();
        $family->setName('Famille');

        $friends = new Group();
        $friends->setName('Amis');

        $work = new Group();
        $work->setName('Travail');

        $manager->persist($family);
        $manager->persist($friends);
        $manager->persist($work);

        $manager->flush();

        $this->addReference('group_family', $family);
        $this->addReference('group_friends', $friends);
        $this->addReference('group_work', $work);
    }
}
