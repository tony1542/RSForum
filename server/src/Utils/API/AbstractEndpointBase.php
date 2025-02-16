<?php

namespace App\Utils\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;
use Throwable;

abstract class AbstractEndpointBase
{
    protected string $base_api_url = '';
    protected string $end_point_url = '';

    protected Client $client;
    protected ApiErrorHandlerInterface $error_handler;

    public function __construct(string $player_name)
    {
        $this->error_handler = $this->getErrorHandler();
        $this->end_point_url .= rawurlencode($player_name);
    }

    abstract protected function getErrorHandler(): ApiErrorHandlerInterface;

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return array
     *
     * @throws RequestException|ApiException
     */
    public function call(): array
    {
        $full_url = $this->base_api_url . $this->end_point_url;

        try {
            $body = $this->client->request('GET', $full_url)->getBody();
        } catch (Throwable) {
            return [];
        }

        $contents = $body->getContents();
        $this->error_handler->checkForErrors($contents);

        return $this->format($contents);
    }

    abstract public function format(string $body): array;
}
