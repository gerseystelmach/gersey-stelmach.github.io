<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{

    public const SKILLS = ['Html', 'CSS', 'Symfony', 'PHP', 'Javascript', 'Bootstrap', 'Figma'];


    public function load(ObjectManager $manager)
    {
        foreach (self::SKILLS as $key => $skillName) {
            $skill = new Skill();
            $skill->setName($skillName);
            $skill->setCategory($this->getReference('category_' . $key));           
            $manager->persist($skill);
            $this->setReference('skill_' . $key, $skill);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,

        ];
    }
}
