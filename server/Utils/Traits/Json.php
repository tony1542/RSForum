<?php

namespace App\Utils\Traits;

trait Json
{
     public function toJson($data): bool|string
     {
         return json_encode($data);
     }
}
