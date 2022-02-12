<?php

namespace App\Controllers;

use App\Models\RSS\HomePage;

class ExternalFeedsController extends AbstractBaseController
{
    public function canAccess(string $action, array $parameters = []): bool
    {
        return true;
    }

    public function home(): void
    {
        $rss = new HomePage('https://secure.runescape.com/m=news/a=13/latest_news.rss?oldschool=true');
        jsonResponse($rss->getContents());
    }
}
