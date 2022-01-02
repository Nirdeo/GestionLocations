<?php

namespace App\DataFixtures;

use App\Entity\Residence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResidenceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 11; $i++) {
            $residence = new Residence();
            $residence
                ->setCity('Paris');
            $this->addReference('residence-' . $i, $residence);
            $manager->persist($residence);
        }

        $manager->flush();
    }
}
