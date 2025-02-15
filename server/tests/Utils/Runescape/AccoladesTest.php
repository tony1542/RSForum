<?php

namespace Tests\Utils\Runescape;

use App\Utils\Runescape\Accolades;
use PHPUnit\Framework\TestCase;

class AccoladesTest extends TestCase
{
    public function testGetAccoladeIconFromIndex(): void
    {
        $this->assertSame('/public/Images/OSRS/AccoladesTest/Bounty Hunter - Hunter.webp', Accolades::getAccoladeIconFromIndex(0));
    }

    public function testGetAccoladeFromIndex(): void
    {
        $this->assertSame('Bounty Hunter - Hunter', Accolades::getAccoladeFromIndex(0));
        $this->assertSame('', Accolades::getAccoladeFromIndex(9999));
    }
}