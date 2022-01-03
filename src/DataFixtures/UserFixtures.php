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
        $user1 = new User();
        $password1 = $this->passwordHasher->hashPassword($user1, 'pass_1234');
        $user1
            ->setEmail('test@example.com')
            ->setPassword($password1)
            ->setRoles(['ROLE_OWNER']);
        $manager->persist($user1);
        $manager->flush();

        $user2 = new User();
        $password2 = $this->passwordHasher->hashPassword($user2, 'pass_1234');
        $user2
            ->setEmail('test@example.com')
            ->setPassword($password2)
            ->setRoles(['ROLE_TENANT']);
        $manager->persist($user2);
        $manager->flush();

        $user3 = new User();
        $password3 = $this->passwordHasher->hashPassword($user3, 'pass_1234');
        $user3
            ->setEmail('test@example.com')
            ->setPassword($password3)
            ->setRoles(['ROLE_REPRESENTATIVE']);
        $manager->persist($user3);
        $manager->flush();
    }
}
