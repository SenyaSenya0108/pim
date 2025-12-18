<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Property;
use App\Entity\PropertyValue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyValueFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("ru_RU");

        $batchSize = 4000;
        for ($i = 1; $i < ProductFixtures::PRODUCT_COUNT; $i++) {
            $product = $this->getReference("product-$i", Product::class);
            for ($j = 1; $j <= PropertyFixtures::PROPERTY_COUNT; $j++) {
                $property = $this->getReference("property-$j", Property::class);
                $propertyValue = (new PropertyValue())
                    ->setProduct($product)
                    ->setProperty($property)
                    ->setValue($faker->word());

                $manager->persist($propertyValue);
            }

            if (($i % $batchSize) === 0) {
                $manager->flush();
                $manager->clear();
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
            PropertyFixtures::class
        ];
    }
}
