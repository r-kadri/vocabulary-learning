<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use App\Entity\GoalList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GoalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');
        
        $goalLists = $manager->getRepository(GoalList::class)->findAll();

        // Create 150 fake goals
        for ($i = 1; $i <= 150; $i++) {
            $goal = new Goal();
            $goal
                ->setName($faker->word())
                ->setIsDone($faker->randomNumber(1))
                ->setGoalList($faker->randomElement($goalLists));
            $manager->persist($goal);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GoalListFixtures::class,
        ];
    }

}
