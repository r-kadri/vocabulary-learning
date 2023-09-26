<?php

namespace App\DataFixtures;

use App\Entity\Word;
use App\Entity\WordLevel;
use App\Entity\WordList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WordFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');

        $wordLists = $manager->getRepository(WordList::class)->findAll();
        $wordLevels = $manager->getRepository(WordLevel::class)->findAll();

        // Create 500 fake words
        for ($i = 1; $i <= 500; $i++) {
            $word = new Word();
            $word
                ->setOriginal($faker->word)
                ->setEnTranslation($faker->word)
                ->setList($faker->randomElement($wordLists))
                ->setLevel($faker->randomElement($wordLevels));
            $manager->persist($word);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            WordListFixtures::class,
            WordLevelFixtures::class,
        ];
    }
}
