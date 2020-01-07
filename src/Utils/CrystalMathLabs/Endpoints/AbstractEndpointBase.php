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
    protected $end_point_url = '';
    
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
     */
    public function call()
    {
        $full_url = $this->base_api_url . $this->end_point_url;
        
        $body = $this->client->request('GET', $full_url)->getBody();
        $contents = substr($body->getContents(), 3, 5);
        $this->error_handler->checkForErrors($contents);
        
        return $this->format($body);
    }
    
    public abstract function format(StreamInterface $data);
    
    /**
     * Initial format based on how the vast majority of the API Calls are returned
     *
     * @param StreamInterface $result
     *
     * @return array
     */
    public function formatStandard(StreamInterface $result)
    {
        return explode("\n", $result);
    }
}
