<?php

namespace App\Utils\API\OSRS;

use App\Utils\API\ApiException;
use App\Utils\API\OSRS\Endpoints\Accolades;
use App\Utils\API\OSRS\Endpoints\Stats;
use GuzzleHttp\Exception\RequestException;

class Api
{
    public static function getStatsForPlayer(string $player_name, int $account_type_id): array
    {
        try {
            $stats_for_player = new Stats($player_name, $account_type_id);

            return $stats_for_player->call();
        } catch (RequestException|ApiException $e) {
            return [];
        }
    }

    public static function getAccoladesForPlayer(string $player_name, int $account_type_id): array
    {
        try {
            $accolades_for_player = new Accolades($player_name, $account_type_id);

            return $accolades_for_player->call();
        } catch (RequestException|ApiException $e) {
            return [];
        }
    }
}
