<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            'French' => 'fr',
            'English' => 'en',
            'Spanish' => 'es',
            'German' => 'de',
            'Italian' => 'it',
            'Portuguese' => 'pt',
            'Russian' => 'ru',
            'Chinese' => 'zh',
            'Japanese' => 'ja',
            'Arabic' => 'ar',
            'Turkish' => 'tr',
            'Dutch' => 'nl',
            'Greek' => 'el',
            'Romanian' => 'ro'
        ];

        foreach ($data as $name => $iso639) {
            $language = new Language();
            $language
                ->setName($name)
                ->setIso639($iso639);
                
            $manager->persist($language);
        }
        $manager->flush();
    }
}
