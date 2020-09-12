<?php

namespace App\Utils\API\CrystalMathLabs;

use App\Utils\API\CrystalMathLabs\Endpoints\CurrentPlayerCount;
use App\Utils\API\CrystalMathLabs\Endpoints\Stats;
use App\Utils\API\CrystalMathLabs\Endpoints\TopPlayers;
use App\Utils\API\ApiException;
use App\Utils\Http\Session;
use GuzzleHttp\Exception\RequestException;

class Api
{
    public static function getCurrentPlayerCount(): ?array
    {
        try {
            $current_player_count = new CurrentPlayerCount();
    
            return $current_player_count->call();
        } catch (RequestException|ApiException $e) {
            return null;
        }
    }
    
    public static function getCurrentTopPlayers(): ?array
    {
        try {
            $top_players = new TopPlayers(
                Session::get(TopPlayers::TIME_PERIOD_NAME)
            );
    
            return $top_players->call();
        } catch (RequestException|ApiException $e) {
            return null;
        }
    }

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
