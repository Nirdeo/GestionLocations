<?php

namespace App\DataFixtures;

use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 6; $i++) {
            $rent = new Rent();
            $rent
                ->setInventoryFile('Canapé')
                ->setTenant($this->getReference('user-' . $i))
                ->setResidence($this->getReference('residence-' . $i))
                ->setTenantValidatedAt(new \DateTime('now'))
                ->setTenantSignature('Signature du locataire n°' . $i)
                ->setTenantComments('Très bien')
                ->setRepresentativeComments('Très bien')
                ->setRepresentativeSignature('AirBnb')
                ->setRepresentativeValidatedAt(new \DateTime('now'))
                ->setArrivalDate(new \DateTime('2019-01-' . $i))
                ->setDepartureDate(new \DateTime('2019-02-' . $i));
            $manager->persist($rent);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ResidenceFixtures::class,
        ];
    }
}
