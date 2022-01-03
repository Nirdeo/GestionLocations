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
        for ($i = 1; $i < 6; $i++) {
            $residence = new Residence();
            $residence
                ->setName('Residence ' . $i)
                ->setOwner($this->getReference('user-' . $i))
                ->setRepresentative($this->getReference('user-' . $i))
                ->setInventoryFile('Canapé')
                ->setAddress('12 Rue de la Paix')
                ->setCountry('France')
                ->setCity('Paris')
                ->setZipCode('75000');
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
