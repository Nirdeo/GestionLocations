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
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $roles = array(['ROLE_OWNER'], ['ROLE_TENANT'], ['ROLE_REPRESENTATIVE']);
            $rand_keys = array_rand($roles);
            $password = $this->passwordHasher->hashPassword($user, 'pass_1234' . $i);
            $user
                ->setEmail('test@example' . $i . 'com')
                ->setPassword($password)
                ->setIsVerified(true)
                ->setRoles($roles[$rand_keys]);
            $this->addReference('user-' . $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
