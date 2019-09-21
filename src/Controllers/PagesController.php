<?php

namespace App\Controllers;

class PagesController extends AbstractBaseController {
    public function index()
    {
        view('home_page');
    }
    
    public function canAccess($action, $parameters = []) {
        return true;
    }
}
