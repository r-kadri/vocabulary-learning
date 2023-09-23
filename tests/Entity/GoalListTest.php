<?php

namespace App\Tests\Entity;

use App\Entity\GoalList;
use App\Entity\User;
use App\Entity\Language;
use App\Entity\Goal;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class GoalListTest extends TestCase
{
    public function testGetId(): void
    {
        $goalList = new GoalList();
        $this->assertNull($goalList->getId());
    }

    public function testGetUser(): void
    {
        $user = new User();
        $goalList = new GoalList();
        $goalList->setUser($user);
        $this->assertSame($user, $goalList->getUser());
    }

    public function testGetLanguage(): void
    {
        $language = new Language();
        $goalList = new GoalList();
        $goalList->setLanguage($language);
        $this->assertSame($language, $goalList->getLanguage());
    }

    public function testGetGoals(): void
    {
        $goalList = new GoalList();
        $this->assertInstanceOf(ArrayCollection::class, $goalList->getGoals());
    }

    public function testAddGoal(): void
    {
        $goalList = new GoalList();
        $goal = new Goal();
        $goalList->addGoal($goal);
        $this->assertTrue($goalList->getGoals()->contains($goal));
        $this->assertSame($goalList, $goal->getGoalList());
    }

    public function testRemoveGoal(): void
    {
        $goalList = new GoalList();
        $goal = new Goal();
        $goalList->addGoal($goal);
        $goalList->removeGoal($goal);
        $this->assertFalse($goalList->getGoals()->contains($goal));
        $this->assertNull($goal->getGoalList());
    }
}
