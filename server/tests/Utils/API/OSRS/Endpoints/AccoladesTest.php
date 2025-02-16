<?php

namespace Tests\Utils\API\OSRS\Endpoints;

use App\Utils\API\OSRS\Endpoints\Accolades;
use App\Utils\Runescape\AccountType;
use PHPUnit\Framework\TestCase;

class AccoladesTest extends TestCase
{
    public function testCall(): void
    {
        $accolades_for_player = new Accolades('o Tony', AccountType::PLAYER_TYPE_IRONMAN);
        $result = $accolades_for_player->call();
        $this->assertNotEmpty($result);
    }
}