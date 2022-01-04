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
        for ($i = 1; $i < 10; $i++) {
            $rent = new Rent();
            $rent
                ->setInventoryFile('Canapé')
                ->setTenant($this->getReference('user-' . random_int(1, 5)))
                ->setResidence($this->getReference('residence-' . random_int(6, 9)))
                ->setTenantValidatedAt(new \DateTime('now'))
                ->setTenantSignature('Signature du locataire n°' . $i)
                ->setTenantComments('Commentaire-' . $i)
                ->setRepresentativeComments('Commentaire-' . $i)
                ->setRepresentativeSignature('Signature du représentant n°' . $i)
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
