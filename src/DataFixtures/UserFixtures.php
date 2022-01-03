<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 6; $i++) {
            $user = new User();
            $password = $this->passwordHasher->hashPassword($user, 'pass_1234');
            $user
                ->setEmail('test@example' . $i . 'com')
                ->setPassword($password)
                ->setIsVerified(true)
                ->setRoles(['ROLE_OWNER']);
            $this->addReference('user-' . $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
