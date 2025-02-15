<?php

namespace App\Utils\Http;

class Server
{
    public function getRoot(): string
    {
        if ($this->isCommandLine()) {
            return $this->getOptions()['PWD'];
        }

        return $this->getOptions()['DOCUMENT_ROOT'];
    }

    public function isCommandLine(): bool
    {
        return PHP_SAPI === 'cli';
    }

    public function getOptions(): array
    {
        return $_SERVER;
    }

    public function getAuthHeader(): string
    {
        $header = $this->getOptions()['HTTP_AUTHORIZATION'] ?? '';

        if ($header === 'Bearer' || $header === '') {
            return '';
        }

        $header = explode(' ', $header)[1];

        if ($header === 'null') {
            return '';
        }

        return $header;
    }

    public function isLocalHost(): bool
    {
        if ($this->isCommandLine()) {
            return true;
        }

        $address = $this->getOptions()['REMOTE_ADDR'];

        $whitelist = [
            '127.0.0.1',
            '::1',
            '[::1]'
        ];

        if (in_array($address, $whitelist)) {
            return true;
        }

        return $this->getOptions()['HTTP_HOST'] === 'localhost';
    }
}
