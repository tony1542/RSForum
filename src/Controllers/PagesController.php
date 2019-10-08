<?php

namespace App\Controllers;

class PagesController extends AbstractBaseController
{
    public function canAccess($action, $parameters = [])
    {
        return true;
    }
    
    public function index()
    {
        view('home_page');
    }
}
