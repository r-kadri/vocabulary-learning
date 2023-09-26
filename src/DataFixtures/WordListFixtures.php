<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\User;
use App\Entity\WordList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WordListFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');
        
        $languages = $manager->getRepository(Language::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();

        // Create 20 fake word lists
        for ($i = 1; $i <= 20; $i++) {
            $wordList = new WordList();
            $wordList
                ->setName($faker->sentence(3))
                ->setUser($faker->randomElement($users))
                ->setLanguage($faker->randomElement($languages));
            $manager->persist($wordList);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LanguageFixtures::class,
            UserFixtures::class,
        ];
    }
}
