<?php

namespace Tests\Utils\API\OSRS;

use App\Utils\API\OSRS\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetStatsForPlayer(): void
    {
        $this->assertNotEmpty(Api::getStatsForPlayer('Lynx Titan', 0));
        $this->assertTrue(true);
    }

    public function testGetAccoladesForPlayer(): void
    {
        $this->assertNotEmpty(Api::getAccoladesForPlayer('Lynx Titan', 0));
        $this->assertTrue(true);
    }
}