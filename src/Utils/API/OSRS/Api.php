<?php

namespace App\Utils\API\OSRS;

use App\Utils\API\ApiException;
use App\Utils\API\OSRS\Endpoints\Stats;
use GuzzleHttp\Exception\RequestException;

class Api
{
    public static function getStatsForPlayer(string $player_name): array
    {
        try {
            $stats_for_player = new Stats($player_name);
        
            return $stats_for_player->call();
        } catch (RequestException|ApiException $e) {
            return [];
        }
    }
}
