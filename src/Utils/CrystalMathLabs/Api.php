<?php

namespace App\Utils\CrystalMathLabs;

use App\Utils\CrystalMathLabs\Endpoints\CurrentPlayerCount;
use App\Utils\CrystalMathLabs\Endpoints\Stats;
use App\Utils\CrystalMathLabs\Endpoints\TopPlayers;
use App\Utils\CrystalMathLabs\Exceptions\ApiException;
use App\Utils\Http\Session;
use GuzzleHttp\Exception\GuzzleException;

class Api
{
    /**
     * @return mixed
     */
    public static function getCurrentPlayerCount()
    {
        try {
            $current_player_count = new CurrentPlayerCount();
    
            return $current_player_count->call();
        } catch (GuzzleException|ApiException $e) {
            return null;
        }
    }
    
    /**
     * @return array|mixed
     */
    public static function getCurrentTopPlayers()
    {
        try {
            $top_players = new TopPlayers(
                Session::get(TopPlayers::TIME_PERIOD_NAME)
            );
    
            return $top_players->call();
        } catch (GuzzleException|ApiException $e) {
            return null;
        }
    }
    
    /**
     * @param string $playerName
     *
     * @return array|mixed
     */
    public static function getStatsForPlayer(string $playerName)
    {
        try {
            $stats_for_player = new Stats($playerName);
    
            return $stats_for_player->call();
        } catch (GuzzleException|ApiException $e) {
            return null;
        }
    }
}