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
            'name' => 'E-commerce',
            'article' => "The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether.",
        ],
        [
            'name' => 'Web Design',
            'article' => "The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether.",
        ],
        [
            'name' => 'Blog with CMS',
            'article' => "The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether.",
        ],
        [
            'name' => 'System to save photos',
            'article' => "The advantage of using a VR rig without a tether is huge because in a complex movement-oriented game you tend to get tangled in the tether.",
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

            $urlImage = 'https://picsum.photos/800/400';
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
