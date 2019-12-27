<?php

namespace App\Controllers;

class PagesController extends AbstractBaseController
{
    protected function getIncludePrefix()
    {
        return 'pages/';
    }
    
    public function canAccess($action, $parameters = [])
    {
        return true;
    }
    
    public function index()
    {
        view($this->getIncludePrefix() . 'home_page');
    }
}
