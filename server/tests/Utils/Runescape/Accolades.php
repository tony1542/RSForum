<?php

namespace Tests\Utils\Runescape;

use PHPUnit\Framework\TestCase;

class Accolades extends TestCase
{
    public function testGetAccoladeIconFromIndex(): void
    {
        $this->assertSame('/public/Images/OSRS/Accolades/Bounty Hunter - Hunter.webp', \App\Utils\Runescape\Accolades::getAccoladeIconFromIndex(0));
    }

    public function testGetAccoladeFromIndex(): void
    {
        $this->assertSame('Bounty Hunter - Hunter', \App\Utils\Runescape\Accolades::getAccoladeFromIndex(0));
        $this->assertSame('', \App\Utils\Runescape\Accolades::getAccoladeFromIndex(9999));
    }
}