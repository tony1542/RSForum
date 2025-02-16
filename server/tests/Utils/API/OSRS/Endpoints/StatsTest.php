<?php

namespace Tests\Utils\API\OSRS\Endpoints;

use App\Utils\API\OSRS\Endpoints\Stats;
use App\Utils\Runescape\AccountType;
use PHPUnit\Framework\TestCase;

class StatsTest extends TestCase
{
    public function testCall(): void
    {
        $stats_for_player = new Stats('o Tony', AccountType::PLAYER_TYPE_IRONMAN);
        $result = $stats_for_player->call();
        $this->assertNotEmpty($result);
    }
}