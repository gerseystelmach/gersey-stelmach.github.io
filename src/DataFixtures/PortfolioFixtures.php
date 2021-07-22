<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Portfolio;
use App\DataFixtures\SkillFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PortfolioFixtures extends Fixture implements DependentFixtureInterface
{

    public const PORTFOLIOS = [
        [
            'name' => 'Oculus Quest 2: Step Into the Untethered Future of VR',
            'article' => "
            The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether. Let's talk about the Oculus Quest 2 this week and the announcement that this class of products is about to embrace 5G for its next generation. We'll close with the product of the week, a new webcam from Dell that may be perfect for those of us still working from home.",
        ],
        [
            'name' => 'Windows 11: The Beginning of a New PC Age',
            'article' => "
            The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether. Let's talk about the Oculus Quest 2 this week and the announcement that this class of products is about to embrace 5G for its next generation. We'll close with the product of the week, a new webcam from Dell that may be perfect for those of us still working from home.",
        ],
        [
            'name' => 'HP Sets Example of How to Prioritize Sustainability',
            'article' => "
            The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether. Let's talk about the Oculus Quest 2 this week and the announcement that this class of products is about to embrace 5G for its next generation. We'll close with the product of the week, a new webcam from Dell that may be perfect for those of us still working from home.",
        ],
        [
            'name' => 'Oculus Quest 2: Step Into the Untethered Future of VR',
            'article' => "
            The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether. Let's talk about the Oculus Quest 2 this week and the announcement that this class of products is about to embrace 5G for its next generation. We'll close with the product of the week, a new webcam from Dell that may be perfect for those of us still working from home.",
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PORTFOLIOS as $portfolioData) {

            $portfolio = new Portfolio();
            $portfolio->setProjectName($portfolioData['name']);
            $portfolio->setDescription($portfolioData['article']);
            $portfolio->setUpdatedAt(new DateTime('now'));
            for ($i = 0; $i < count(SkillFixtures::SKILLS); $i++) {
                $portfolio->addTechnology($this->getReference('skill_' . $i));
            }

            $urlImage = 'https://picsum.photos/seed/picsum/500/600';
            $path = uniqid() . '.jpg';

            // Function to save image URL into file
            copy($urlImage, 'public/uploads/article/' . $path);
            $imagePath = '/uploads/article/' . $path;
            $portfolio->setImage($imagePath);
           

            $manager->persist($portfolio);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SkillFixtures::class,

        ];
    }
}
