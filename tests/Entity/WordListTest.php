<?php

namespace App\Tests\Entity;

use App\Entity\WordList;
use App\Entity\Word;
use App\Entity\User;
use App\Entity\Language;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class WordListTest extends TestCase
{
    public function testGetId(): void
    {
        $wordList = new WordList();
        $this->assertNull($wordList->getId());
    }

    public function testGetName(): void
    {
        $wordList = new WordList();
        $wordList->setName('name');
        $this->assertSame('name', $wordList->getName());
    }

    public function testGetWords(): void
    {
        $wordList = new WordList();
        $this->assertInstanceOf(ArrayCollection::class, $wordList->getWords());
    }

    public function testAddWord(): void
    {
        $wordList = new WordList();
        $word = new Word();
        $wordList->addWord($word);
        $this->assertTrue($wordList->getWords()->contains($word));
        $this->assertSame($wordList, $word->getList());
    }

    public function testRemoveWord(): void
    {
        $wordList = new WordList();
        $word = new Word();
        $wordList->addWord($word);
        $wordList->removeWord($word);
        $this->assertFalse($wordList->getWords()->contains($word));
        $this->assertNull($word->getList());
    }

    public function testGetUser(): void
    {
        $wordList = new WordList();
        $user = new User();
        $wordList->setUser($user);
        $this->assertSame($user, $wordList->getUser());
    }

    public function testGetLanguage(): void
    {
        $wordList = new WordList();
        $language = new Language();
        $wordList->setLanguage($language);
        $this->assertSame($language, $wordList->getLanguage());
    }
}
