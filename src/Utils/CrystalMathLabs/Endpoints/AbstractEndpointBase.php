<?php

namespace App\Utils\CrystalMathLabs\Endpoints;

use App\Utils\CrystalMathLabs\Exceptions\ApiErrorHandler;
use App\Utils\CrystalMathLabs\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

abstract class AbstractEndpointBase implements EndpointInterface
{
    protected $base_api_url = 'http://crystalmathlabs.com/tracker/api.php?';
    protected $endpoint_url = '';
    
    /** @var Client */
    protected $client = null;
    
    /** @var ApiErrorHandler */
    protected $error_handler = null;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->error_handler = new ApiErrorHandler();
    }
    
    /**
     * @return array|mixed
     *
     * @throws ApiException
     * @throws GuzzleException
     */
    public function call()
    {
        $fullUrl = $this->base_api_url . $this->endpoint_url;
        
        $body = $this->client->request('GET', $fullUrl)->getBody();
        $contents = substr($body->getContents(), 3, 5);
        $this->error_handler->checkForErrors($contents);
        
        return $this->format($body);
    }
    
    /**
     * @param StreamInterface $data
     *
     * @return mixed
     */
    public abstract function format(StreamInterface $data);
}
