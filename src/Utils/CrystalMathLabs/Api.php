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
     *
     * @throws GuzzleException
     * @throws ApiException
     */
    public function getCurrentPlayerCount()
    {
        $currentPlayerCount = new CurrentPlayerCount();
        
        return $currentPlayerCount->call();
    }
    
    /**
     * @return array|mixed
     *
     * @throws GuzzleException
     * @throws ApiException
     */
    public function getCurrentTopPlayers()
    {
        $topPlayers = new TopPlayers(
            Session::get(TopPlayers::TIME_PERIOD_NAME)
        );
        
        return $topPlayers->call();
    }
    
    /**
     * @param string $playerName
     *
     * @return array|mixed
     *
     * @throws ApiException
     * @throws GuzzleException
     */
    public function getStatsForPlayer(string $playerName)
    {
        $statsForPlayer = new Stats($playerName);
        
        return $statsForPlayer->call();
    }
}