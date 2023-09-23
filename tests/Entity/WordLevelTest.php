<?php

namespace App\Tests\Entity;

use App\Entity\WordLevel;
use App\Entity\Word;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class WordLevelTest extends TestCase
{
    public function testGetId(): void
    {
        $wordLevel = new WordLevel();
        $this->assertNull($wordLevel->getId());
    }

    public function testGetLabel(): void
    {
        $wordLevel = new WordLevel();
        $wordLevel->setLabel('Example Label');
        $this->assertSame('Example Label', $wordLevel->getLabel());
    }

    public function testGetDescription(): void
    {
        $wordLevel = new WordLevel();
        $wordLevel->setDescription('Example Description');
        $this->assertSame('Example Description', $wordLevel->getDescription());
    }

    public function testGetWords(): void
    {
        $wordLevel = new WordLevel();
        $this->assertInstanceOf(ArrayCollection::class, $wordLevel->getWords());
    }

    public function testAddWord(): void
    {
        $wordLevel = new WordLevel();
        $word = new Word();
        $wordLevel->addWord($word);
        $this->assertTrue($wordLevel->getWords()->contains($word));
        $this->assertSame($wordLevel, $word->getLevel());
    }

    public function testRemoveWord(): void
    {
        $wordLevel = new WordLevel();
        $word = new Word();
        $wordLevel->addWord($word);
        $wordLevel->removeWord($word);
        $this->assertFalse($wordLevel->getWords()->contains($word));
        $this->assertNull($word->getLevel());
    }
}
