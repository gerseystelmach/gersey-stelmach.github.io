<?php

namespace App\DataFixtures;

use DateTime;
use  App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    public const CATEGORIES = ['Education', 'Career', 'Development', 'Design', 'Soft Skill', 'Languages', 'Tools'];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key =>  $categoryData) {
            $count = 0;
            $category = new Category();
            $category->setName($categoryData);
            $manager->persist($category);
            $this->setReference('category_' . $key, $category);
            $count++;
        }

        $manager->flush();
    }
}
