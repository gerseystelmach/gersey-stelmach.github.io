<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Experience;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExperienceFixtures extends Fixture implements DependentFixtureInterface
{

    public const EXPERIENCES = [
        [
            'title' => 'Work',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'company' => 'Dream Company',
        ],

        [
            'title' => 'Work2',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'company' => 'Dream Company',

        ],

        [
            'title' => 'Work3',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'company' => 'Dream Company',

        ],

        [
            'title' => 'Study 1',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'company' => 'Dream Company',

        ],
        [
            'title' => 'Study 2',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'company' => 'Dream Company',
        ],
        [
            'title' => 'Study 3',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'company' => 'Dream Company',

        ],
    ];


    public function load(ObjectManager $manager)
    {
        foreach (self::EXPERIENCES as $key => $experienceData) {
            $experience = new Experience();
            $experience->setTitle($experienceData['title']);
            $experience->setCompany($experienceData['company']);
            $experience->setDescription($experienceData['description']);
            $experience->setCategory($this->getReference('category_' . $key));
            $experience->setStartedAt(new DateTime('now'));
            $experience->setFinishedAt(new DateTime('now'));
            $manager->persist($experience);
            
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
