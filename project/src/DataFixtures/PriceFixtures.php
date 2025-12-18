<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Base;
use App\Entity\Price;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PriceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("ru_RU");

        $batchSize = 5000;
        for ($i = 1; $i <= ProductFixtures::PRODUCT_COUNT; $i++) {
            $product = $this->getReference("product-$i", Product::class);
            foreach (BaseFixtures::BASE_NAMES as $baseName) {
                $base = $this->getReference($baseName, Base::class);
                $newPrice = $faker->randomFloat(nbMaxDecimals: 2, max: 11000);
                $oldPrice = $faker->randomFloat(nbMaxDecimals: 2, max: 15000) > $newPrice
                    ? $faker->randomFloat(nbMaxDecimals: 2, max: 15000)
                    : null;

                $price = (new Price())
                    ->setValue($newPrice)
                    ->setOldValue($oldPrice)
                    ->setProduct($product)
                    ->setBase($base);

                $manager->persist($price);
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
            BaseFixtures::class,
            ProductFixtures::class
        ];
    }
}
