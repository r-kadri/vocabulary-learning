<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public const LANGUAGE_ENGLISH_REFERENCE = 'language-english';

    public function load(ObjectManager $manager): void
    {
        // Create entities from data array
        foreach ($this->getLanguageData() as $name => $iso639) {
            $language = new Language();
            $language
                ->setName($name)
                ->setIso639($iso639);
            $manager->persist($language);
            if($iso639 === 'en') $this->addReference(self::LANGUAGE_ENGLISH_REFERENCE, $language);
        }
        $manager->flush();
    }

    private function getLanguageData(): array {
        return [
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
    }
}
