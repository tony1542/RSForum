<?php

namespace App\Controllers;

use App\Utils\Traits\Json;

class PagesController extends AbstractBaseController
{
    use Json;
    
    public function canAccess(string $action, array $parameters = []): bool
    {
        if ($action === 'create') {
            return getSignedInUser()->isAdmin();
        }
        
        return true;
    }
    
    public function index(): void
    {
        echo $this->toJson([
            'Home page'
        ]);
    }
    
    public function create(): void
    {
        // TODO
    }
}
