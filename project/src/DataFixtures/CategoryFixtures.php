<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    const int COUNT_PARENT_CATEGORY = 10;
    const int COUNT_LEVEL_TWO_CATEGORY = 300;
    const int COUNT_LEVEL_THREE_CATEGORY = 500;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("ru_RU");

        $parentCategories = [];
        for ($i = 0; $i <= self::COUNT_PARENT_CATEGORY; $i++) {
            $category = new Category();
            $category
                ->setName($faker->title())
                ->setSlug($faker->slug());
            $parentCategories[$i] = $category;
            $manager->persist($category);
            $this->addReference("category-$i", $category);
        }

        $indexParentCategory = 0;
        $levelTwoCategories = [];
        for ($i = self::COUNT_PARENT_CATEGORY + 1; $i <= self::COUNT_LEVEL_TWO_CATEGORY; $i++) {
            if ($indexParentCategory > self::COUNT_PARENT_CATEGORY) {
                $indexParentCategory = 0;
            }
            $category = new Category();
            $category
                ->setName($faker->title())
                ->setSlug($faker->slug())
                ->setParent($parentCategories[$indexParentCategory]);
            $levelTwoCategories[$i] = $category;

            $indexParentCategory++;
            $manager->persist($category);
            $this->addReference("category-$i", $category);
        }

        $indexParentCategory = self::COUNT_PARENT_CATEGORY + 1;
        for ($i = self::COUNT_LEVEL_TWO_CATEGORY + 1; $i <= self::COUNT_LEVEL_THREE_CATEGORY; $i++) {
            if ($indexParentCategory >= self::COUNT_LEVEL_THREE_CATEGORY) {
                $indexParentCategory = self::COUNT_PARENT_CATEGORY + 1;
            }
            $category = new Category();
            $category
                ->setName($faker->title())
                ->setSlug($faker->slug())
                ->setParent($levelTwoCategories[$indexParentCategory]);

            $indexParentCategory++;
            $manager->persist($category);
            $this->addReference("category-$i", $category);
        }

        $manager->flush();
    }
}
