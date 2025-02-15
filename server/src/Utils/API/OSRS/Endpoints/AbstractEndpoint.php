<?php

namespace App\Utils\API\OSRS\Endpoints;

use App\Utils\API\AbstractEndpointBase;
use App\Utils\API\ApiErrorHandlerInterface;
use App\Utils\API\OSRS\Exceptions\ApiErrorHandler;
use App\Utils\Runescape\AccountType;
use Psr\Http\Message\StreamInterface;

abstract class AbstractEndpoint extends AbstractEndpointBase
{
    protected string $base_api_url = 'https://secure.runescape.com/m=hiscore_oldschool%s/index_lite.ws?';

    protected string $ironman_method = '_ironman';
    protected string $hardcore_ironman_method = '_hardcore_ironman';
    protected string $ultimate_ironman_method = '_ultimate';

    public function __construct(string $player_name, int $player_type = 0)
    {
        parent::__construct($player_name);
        $this->setBaseApiUrl($player_type);
    }

    protected function setBaseApiUrl($player_type): void
    {
        $method = match ($player_type) {
            AccountType::PLAYER_TYPE_IRONMAN => $this->ironman_method,
            AccountType::PLAYER_TYPE_HARDCORE_IRONMAN => $this->hardcore_ironman_method,
            AccountType::PLAYER_TYPE_ULTIMATE_IRONMAN => $this->ultimate_ironman_method,
            default => ''
        };

        $this->base_api_url = sprintf($this->base_api_url, $method);
    }

    protected function getErrorHandler(): ApiErrorHandlerInterface
    {
        return new ApiErrorHandler();
    }

    protected function formatStandard(StreamInterface $body): array
    {
        $data = (string)$body;

        return explode("\n", $data);
    }
}
