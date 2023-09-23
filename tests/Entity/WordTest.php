<?php

namespace App\Tests\Entity;

use App\Entity\Word;
use App\Entity\WordList;
use App\Entity\WordLevel;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    public function testGetId(): void
    {
        $word = new Word();
        $this->assertNull($word->getId());
    }

    public function testGetOriginal(): void
    {
        $word = new Word();
        $word->setOriginal('Example Word');
        $this->assertSame('Example Word', $word->getOriginal());
    }

    public function testGetEnTranslation(): void
    {
        $word = new Word();
        $word->setEnTranslation('Translation');
        $this->assertSame('Translation', $word->getEnTranslation());
    }

    public function testGetLevel(): void
    {
        $word = new Word();
        $level = new WordLevel();
        $word->setLevel($level);
        $this->assertSame($level, $word->getLevel());
    }

    public function testGetList(): void
    {
        $word = new Word();
        $list = new WordList();
        $word->setList($list);
        $this->assertSame($list, $word->getList());
    }
}
