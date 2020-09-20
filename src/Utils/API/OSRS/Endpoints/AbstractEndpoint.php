<?php

namespace App\Utils\API\OSRS\Endpoints;

use App\Utils\API\AbstractEndpointBase;
use App\Utils\API\ApiErrorHandlerInterface;
use App\Utils\API\OSRS\Exceptions\ApiErrorHandler;

abstract class AbstractEndpoint extends AbstractEndpointBase
{
    protected string $base_api_url = 'https://secure.runescape.com/m=hiscore_oldschool/index_lite.ws?';

    protected function getErrorHandler(): ApiErrorHandlerInterface
    {
        return new ApiErrorHandler();
    }
}
