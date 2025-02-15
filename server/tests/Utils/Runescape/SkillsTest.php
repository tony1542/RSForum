<?php

namespace Tests\Utils\Runescape;

use PHPUnit\Framework\TestCase;
use App\Utils\Runescape\Skills;

class SkillsTest extends TestCase
{
    public function testGetSkillNameFromIndex()
    {
        $this->assertEquals('Overall', Skills::getSkillNameFromIndex(0));
        $this->assertEquals('Attack', Skills::getSkillNameFromIndex(1));
        $this->assertEquals('Defence', Skills::getSkillNameFromIndex(2));
        $this->assertEquals('Strength', Skills::getSkillNameFromIndex(3));
        $this->assertEquals('Hitpoints', Skills::getSkillNameFromIndex(4));
    }

    public function testGetSkillIconFromIndex()
    {
        $this->assertEquals('/public/Images/OSRS/Skills/overall.png', Skills::getSkillIconFromIndex(0));
        $this->assertEquals('/public/Images/OSRS/Skills/attack.png', Skills::getSkillIconFromIndex(1));
        $this->assertEquals('/public/Images/OSRS/Skills/defence.png', Skills::getSkillIconFromIndex(2));
        $this->assertEquals('/public/Images/OSRS/Skills/strength.png', Skills::getSkillIconFromIndex(3));
        $this->assertEquals('/public/Images/OSRS/Skills/hitpoints.png', Skills::getSkillIconFromIndex(4));
    }

    public function testInvalidIndex()
    {
        $this->assertSame('', Skills::getSkillNameFromIndex(999));
    }
}

