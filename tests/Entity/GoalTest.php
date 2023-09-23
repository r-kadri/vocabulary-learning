<?php

namespace App\Tests\Entity;

use App\Entity\Goal;
use App\Entity\GoalList;
use PHPUnit\Framework\TestCase;

class GoalTest extends TestCase
{
    public function testGetId(): void
    {
        $goal = new Goal();
        $this->assertNull($goal->getId());
    }

    public function testGetName(): void
    {
        $goal = new Goal();
        $goal->setName('Example Goal');
        $this->assertSame('Example Goal', $goal->getName());
    }

    public function testIsDone(): void
    {
        $goal = new Goal();
        $goal->setIsDone(true);
        $this->assertTrue($goal->isIsDone());
    }

    public function testGetGoalList(): void
    {
        $goal = new Goal();
        $goalList = new GoalList();
        $goal->setGoalList($goalList);
        $this->assertSame($goalList, $goal->getGoalList());
    }
}
