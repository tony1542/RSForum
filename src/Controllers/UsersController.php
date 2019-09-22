<?php

namespace App\Controllers;

use App\Http\Request;

class UsersController extends AbstractBaseController
{
    public function canAccess($action, $parameters = []) {
       return true;
    }
    
    public function index()
    {
    
    }
    
    public function register()
    {
        $request = new Request();
        $request->dump();
        
        view('register');
    }
    public function signin()
    {
        view('signin');
    }
}
