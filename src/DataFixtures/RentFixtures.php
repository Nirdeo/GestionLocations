<?php

namespace App\DataFixtures;

use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 11; $i++) {
            $rent = new Rent();
            $rent
                ->setArrivalDate(new \DateTime('2019-01-10' . $i));
            $this->addReference('rent-' . $i, $rent);
            $manager->persist($rent);
        }

        $manager->flush();
    }
}
