<?php

namespace App\Utils\CrystalMathLabs\Endpoints;

use App\Utils\CrystalMathLabs\Exceptions\ApiErrorHandler;
use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;
use Throwable;

abstract class AbstractEndpointBase implements EndpointInterface
{
    protected string $base_api_url = 'http://crystalmathlabs.com/tracker/api.php?';
    protected string $end_point_url = '';
    
    protected Client $client;
    protected ApiErrorHandler $error_handler;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->error_handler = new ApiErrorHandler();
    }
    
    public function call()
    {
        $full_url = $this->base_api_url . $this->end_point_url;
    
        try {
            $body = $this->client->request('GET', $full_url)->getBody();
        } catch (Throwable $t) {
            return [];
        }
        
        $contents = substr($body->getContents(), 3, 5);
        $this->error_handler->checkForErrors($contents);
        
        return $this->format($body);
    }
    
    abstract public function format(StreamInterface $data);
    
    /*
     * Initial format based on how the vast majority of the API Calls are returned
     */
    public function formatStandard(StreamInterface $result): array
    {
        return explode("\n", $result);
    }
}
