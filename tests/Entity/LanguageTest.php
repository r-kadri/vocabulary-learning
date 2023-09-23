<?php

namespace App\Tests\Entity;

use App\Entity\Language;
use App\Entity\User;
use App\Entity\WordList;
use App\Entity\GoalList;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    public function testGetId(): void
    {
        $language = new Language();
        $this->assertNull($language->getId());
    }

    public function testGetName(): void
    {
        $language = new Language();
        $language->setName('Example Language');
        $this->assertSame('Example Language', $language->getName());
    }

    public function testGetIso639(): void
    {
        $language = new Language();
        $language->setIso639('eng');
        $this->assertSame('eng', $language->getIso639());
    }

    public function testGetUsers(): void
    {
        $language = new Language();
        $this->assertInstanceOf(ArrayCollection::class, $language->getUsers());
    }

    public function testAddUser(): void
    {
        $language = new Language();
        $user = new User();
        $language->addUser($user);
        $this->assertTrue($language->getUsers()->contains($user));
        $this->assertTrue($user->getLanguages()->contains($language));
    }

    public function testRemoveUser(): void
    {
        $language = new Language();
        $user = new User();
        $language->addUser($user);
        $language->removeUser($user);
        $this->assertFalse($language->getUsers()->contains($user));
        $this->assertFalse($user->getLanguages()->contains($language));
    }

    public function testGetWordLists(): void
    {
        $language = new Language();
        $this->assertInstanceOf(ArrayCollection::class, $language->getWordLists());
    }

    public function testAddWordList(): void
    {
        $language = new Language();
        $wordList = new WordList();
        $language->addWordList($wordList);
        $this->assertTrue($language->getWordLists()->contains($wordList));
        $this->assertSame($language, $wordList->getLanguage());
    }

    public function testRemoveWordList(): void
    {
        $language = new Language();
        $wordList = new WordList();
        $language->addWordList($wordList);
        $language->removeWordList($wordList);
        $this->assertFalse($language->getWordLists()->contains($wordList));
        $this->assertNull($wordList->getLanguage());
    }

    public function testGetGoalLists(): void
    {
        $language = new Language();
        $this->assertInstanceOf(ArrayCollection::class, $language->getGoalLists());
    }

    public function testAddGoalList(): void
    {
        $language = new Language();
        $goalList = new GoalList();
        $language->addGoalList($goalList);
        $this->assertTrue($language->getGoalLists()->contains($goalList));
        $this->assertSame($language, $goalList->getLanguage());
    }

    public function testRemoveGoalList(): void
    {
        $language = new Language();
        $goalList = new GoalList();
        $language->addGoalList($goalList);
        $language->removeGoalList($goalList);
        $this->assertFalse($language->getGoalLists()->contains($goalList));
        $this->assertNull($goalList->getLanguage());
    }
}
