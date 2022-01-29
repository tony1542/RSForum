<?php

namespace App\Models\RSS;

use SimpleXMLElement;

abstract class RSS
{
    protected SimpleXMLElement $contents;

    // TODO save contents to DB with hash for future retrievals
    public function __construct($url)
    {
        $this->contents = simplexml_load_string(file_get_contents($url));
    }

    abstract public function getContents(): SimpleXMLElement;
}
