<?php

namespace App\DataFixtures;

use App\Entity\WordLevel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WordLevelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            'Freshly Learned' => 'This level contain words that the user has just learned and that are not yet well memorised.',
            'Review' => 'These are words that the user has already learnt, but which need to be revised to be better memorized.',
            'Mastered' => 'These words are perfectly mastered by the member and can be recalled effortlessly.'
        ];

        foreach ($data as $label => $description) {
            $level = new WordLevel();
            $level
                ->setLabel($label)
                ->setDescription($description);
            $manager->persist($level);
        }

        $manager->flush();
    }
}
