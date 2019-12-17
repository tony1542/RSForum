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
            $currentPlayerCount = new CurrentPlayerCount();
    
            return $currentPlayerCount->call();
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
            $topPlayers = new TopPlayers(
                Session::get(TopPlayers::TIME_PERIOD_NAME)
            );
    
            return $topPlayers->call();
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
            $statsForPlayer = new Stats($playerName);
    
            return $statsForPlayer->call();
        } catch (GuzzleException|ApiException $e) {
            return null;
        }
    }
}