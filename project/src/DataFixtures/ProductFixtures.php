<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    const int PRODUCT_COUNT = 1000;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("ru_RU");

        for ($i = 1; $i <= self::PRODUCT_COUNT; $i++) {
            $category = $this->getReference("category-" . mt_rand(1, CategoryFixtures::COUNT_LEVEL_THREE_CATEGORY), Category::class);
            $product = new Product();
            $product
                ->setName($faker->word())
                ->setDescription($faker->text())
                ->setVendorCode($faker->company())
                ->setCategory($category);

            $manager->persist($product);
            $this->addReference("product-$i", $product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BaseFixtures::class,
            CategoryFixtures::class
        ];
    }
}
