<?php

namespace Tests\Utils\Runescape;

use App\Utils\Runescape\AccountType;
use PHPUnit\Framework\TestCase;

class AccountTypeTest extends TestCase
{
    public function testGetAll(): void
    {
        $this->assertSame([
            0 => 'Normal',
            1 => 'Ironman',
            2 => 'Hardcore Ironman',
            3 => 'Ultimate Ironman'
        ], AccountType::getAll());
    }
}