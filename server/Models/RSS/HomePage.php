<?php

namespace App\Models\RSS;

use SimpleXMLElement;

class HomePage extends RSS
{
    public function getContents(): SimpleXMLElement
    {
        return $this->contents;
    }
}
