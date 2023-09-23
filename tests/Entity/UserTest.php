<?php

namespace App\Tests\Entity;

use App\Entity\GoalList;
use App\Entity\Language;
use App\Entity\User;
use App\Entity\WordList;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId(): void
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testGetEmail(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $this->assertSame('test@example.com', $user->getEmail());
    }

    public function testGetRoles(): void
    {
        $user = new User();
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testGetPassword(): void
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertSame('password', $user->getPassword());
    }

    public function testGetUsername(): void
    {
        $user = new User();
        $user->setUsername('testuser');
        $this->assertSame('testuser', $user->getUsername());
    }

    public function testGetWordLists(): void
    {
        $user = new User();
        $this->assertInstanceOf(Collection::class, $user->getWordLists());
    }

    public function testAddWordList(): void
    {
        $user = new User();
        $wordList = $this->createMock(WordList::class);
        $user->addWordList($wordList);
        $this->assertTrue($user->getWordLists()->contains($wordList));
    }

    public function testRemoveWordList(): void
    {
        $user = new User();
        $wordList = $this->createMock(WordList::class);
        $user->addWordList($wordList);
        $user->removeWordList($wordList);
        $this->assertFalse($user->getWordLists()->contains($wordList));
    }

    public function testGetLanguages(): void
    {
        $user = new User();
        $this->assertInstanceOf(Collection::class, $user->getLanguages());
    }

    public function testAddLanguage(): void
    {
        $user = new User();
        $language = $this->createMock(Language::class);
        $user->addLanguage($language);
        $this->assertTrue($user->getLanguages()->contains($language));
    }

    public function testRemoveLanguage(): void
    {
        $user = new User();
        $language = $this->createMock(Language::class);
        $user->addLanguage($language);
        $user->removeLanguage($language);
        $this->assertFalse($user->getLanguages()->contains($language));
    }

    public function testGetGoalLists(): void
    {
        $user = new User();
        $this->assertInstanceOf(Collection::class, $user->getGoalLists());
    }

    public function testAddGoalList(): void
    {
        $user = new User();
        $goalList = $this->createMock(GoalList::class);
        $user->addGoalList($goalList);
        $this->assertTrue($user->getGoalLists()->contains($goalList));
    }

    public function testRemoveGoalList(): void
    {
        $user = new User();
        $goalList = $this->createMock(GoalList::class);
        $user->addGoalList($goalList);
        $user->removeGoalList($goalList);
        $this->assertFalse($user->getGoalLists()->contains($goalList));
    }
}