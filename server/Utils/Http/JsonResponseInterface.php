<?php

namespace App\Utils\Http;

interface JsonResponseInterface
{
    public function toJson($data): void;
}
