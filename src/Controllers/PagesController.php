<?php

namespace App\Controllers;

use App\Utils\Http\Session;

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
        $user = getSignedInUser();
        
        if ($user->getID() > 0 && !Session::has('home_welcome')) {
           Session::set('name', $user->getUsername());
           Session::set('home_welcome', true);
        }
        
        view($this->getIncludePrefix() . 'home_page');
    }
}
