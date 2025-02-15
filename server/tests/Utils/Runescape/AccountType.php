<?php

namespace Tests\Utils\Runescape;

use PHPUnit\Framework\TestCase;

class AccountType extends TestCase
{
    public function testGetAll(): void
    {
        $this->assertSame([
            0 => 'Normal',
            1 => 'Ironman',
            2 => 'Hardcore Ironman',
            3 => 'Ultimate Ironman'
        ], \App\Utils\Runescape\AccountType::getAll());
    }
}