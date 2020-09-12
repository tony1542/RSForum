<?php

namespace App\Utils\API\CrystalMathLabs\Endpoints;

use App\Utils\API\AbstractEndpointBase;
use App\Utils\API\EndpointInterface;
use Psr\Http\Message\StreamInterface;
use Throwable;

abstract class AbstractEndpoint extends AbstractEndpointBase implements EndpointInterface
{
    protected string $base_api_url = 'http://crystalmathlabs.com/tracker/api.php?';
    protected string $end_point_url = '';
    
    abstract public function format(StreamInterface $data);
    
    /*
     * Initial format based on how the vast majority of the API Calls are returned
     */
    public function formatStandard(StreamInterface $result): array
    {
        return explode("\n", $result);
    }
}
