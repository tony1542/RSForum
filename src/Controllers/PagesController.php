<?php

namespace App\Controllers;

use App\Utils\Http\Session;

class PagesController extends AbstractBaseController
{
    protected function getIncludePrefix(): string
    {
        return 'pages/';
    }
    
    public function canAccess(string $action, array $parameters = []): bool
    {
        return true;
    }
    
    public function index(): void
    {
        $user = getSignedInUser();
        
        if ($user->getID() > 0 && !Session::has('home_welcome')) {
           Session::set('name', $user->getUsername());
           Session::set('home_welcome', true);
        }
        
        view($this->getIncludePrefix() . 'home_page');
    }
}
