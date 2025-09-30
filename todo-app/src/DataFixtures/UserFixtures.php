<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
       $regularUser = new User();
        $regularUser
            ->setEmail('bobby@bob.com')
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'));

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setEmail('admin@mycorp.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'test'));

        $manager->persist($adminUser);

        $manager->flush();
    }
}
