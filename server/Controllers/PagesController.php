<?php

namespace App\Controllers;

class PagesController extends AbstractBaseController
{
    public function canAccess(string $action, array $parameters = []): bool
    {
        if ($action === 'create') {
            return getSignedInUser()->isAdmin();
        }
        
        return true;
    }
    
    public function index(): void
    {
        // TODO
    }
    
    public function create(): void
    {
        // TODO
    }
}
