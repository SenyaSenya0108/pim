<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    const int PROPERTY_COUNT = 8;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("ru_RU");

        for ($i = 1; $i <= self::PROPERTY_COUNT; $i++) {
            $property = new Property();
            $property
                ->setName($faker->unique()->word())
                ->setUnit($faker->randomElement(['шт', 'л', 'мм', 'кг']));
            $manager->persist($property);
            $this->addReference("property-$i", $property);
        }
        $manager->flush();
    }
}
