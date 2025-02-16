<?php

namespace Tests\Utils\API\OSRS;

use App\Utils\API\OSRS\Api;
use App\Utils\Runescape\AccountType;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetStatsForPlayer(): void
    {
        $this->assertNotEmpty(Api::getStatsForPlayer('Lynx Titan', AccountType::PLAYER_TYPE_NORMAL));
        $this->assertNotEmpty(Api::getStatsForPlayer('Iron Hyger', AccountType::PLAYER_TYPE_IRONMAN));
        $this->assertNotEmpty(Api::getStatsForPlayer('groonoomcroo', AccountType::PLAYER_TYPE_HARDCORE_IRONMAN));
        $this->assertNotEmpty(Api::getStatsForPlayer('Settled', AccountType::PLAYER_TYPE_ULTIMATE_IRONMAN));
    }

    public function testGetAccoladesForPlayer(): void
    {
        $this->assertNotEmpty(Api::getAccoladesForPlayer('Lynx Titan', AccountType::PLAYER_TYPE_NORMAL));
    }
}