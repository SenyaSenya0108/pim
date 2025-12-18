<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("ru_RU");
        $user = new User();
        $user
            ->setEmail($faker->unique()->email)
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $manager->flush();
    }
}
