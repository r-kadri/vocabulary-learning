<?php

namespace App\DataFixtures;

use App\Entity\GoalList;
use App\Repository\LanguageRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GoalListFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');

        $languages = $this->entityManager->getRepository(LanguageRepository::class)->findAll();
        $users = $this->entityManager->getRepository(UserRepository::class)->findAll();

        // Create 20 fake goal lists
        for ($i = 1; $i <= 20; $i++) {
            $goalList = new GoalList();
            $goalList
                ->setName($faker->sentence(3))
                ->setUser($faker->randomElement($users))
                ->setLanguage($faker->randomElement($languages));
            $manager->persist($goalList);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            LanguageFixtures::class,
        ];
    }
}
