<?php

namespace App\Controllers;

use App\Utils\Http\Session;

class PagesController extends AbstractBaseController
{
    protected function getModel(): void {}
    protected function getModelClass() : string
    {
        return '';
    }
    
    protected function getIncludePrefix(): string
    {
        return 'pages/';
    }
    
    protected function toView(string $view, array $parameters = []): void
    {
        view($this->getIncludePrefix() . $view, $parameters);
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
        
        $this->toView('home_page');
    }
}
