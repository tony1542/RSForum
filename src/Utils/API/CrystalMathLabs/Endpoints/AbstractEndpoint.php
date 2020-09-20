<?php

namespace App\Utils\API\CrystalMathLabs\Endpoints;

use App\Utils\API\AbstractEndpointBase;
use App\Utils\API\ApiErrorHandlerInterface;
use App\Utils\API\CrystalMathLabs\Exceptions\ApiErrorHandler;
use Psr\Http\Message\StreamInterface;

abstract class AbstractEndpoint extends AbstractEndpointBase
{
    protected string $base_api_url = 'http://crystalmathlabs.com/tracker/api.php?';
    
    protected function getErrorHandler(): ApiErrorHandlerInterface
    {
        return new ApiErrorHandler();
    }
    
    /*
     * Initial format based on how the vast majority of the API Calls are returned
     */
    public function formatStandard(StreamInterface $result): array
    {
        return explode("\n", $result);
    }
}
