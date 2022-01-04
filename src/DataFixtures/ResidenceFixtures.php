<?php

namespace App\DataFixtures;

use App\Entity\Residence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResidenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) {
            $residence = new Residence();
            $residence
                ->setName('Residence ' . $i)
                ->setOwner($this->getReference('user-' . random_int(1, 5)))
                ->setRepresentative($this->getReference('user-' . random_int(6, 9)))
                ->setInventoryFile('Canapé')
                ->setAddress($i . ' Rue de la Paix')
                ->setCountry('France')
                ->setCity('Paris')
                ->setZipCode('7500' . $i);
            $this->addReference('residence-' . $i, $residence);
            $manager->persist($residence);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            UserFixtures::class,
        ];
    }
}
