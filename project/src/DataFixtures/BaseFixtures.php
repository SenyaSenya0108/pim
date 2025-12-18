<?php

namespace App\DataFixtures;

use App\Entity\Base;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BaseFixtures extends Fixture
{
    public const array BASE_NAMES = [
        'Москва',
        'Санкт-Петербург',
        'Нижний Новгород',
        'Калининград',
        'Хабаровск',
        'Красноярск',
        'Владивосток'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::BASE_NAMES as $name) {
            $base = new Base();
            $base->setName($name);

            $manager->persist($base);
            $manager->flush();

            $this->addReference($base->getName(), $base);
        }
    }
}
