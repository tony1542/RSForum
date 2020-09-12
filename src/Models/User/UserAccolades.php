<?php

namespace App\Models\User;

use App\Utils\API\OSRS\Api as OSRS;

class UserAccolades
{
    protected array $accolades = [];
    protected string $username;
    
    public function __construct(string $username)
    {
        $this->username = $username;
        $this->accolades = OSRS::getAccoladesForPlayer($username);
    }
    
    public function getAccolades(): array
    {
        return $this->accolades;
    }
}
