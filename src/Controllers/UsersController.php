<?php

namespace App\Controllers;

class UsersController extends AbstractBaseController
{
    public function canAccess($action, $parameters = []) {
       return true;
    }
    
    public function index() : void
    {
    
    }
    
    public function register()
    {
        view('register');
    }
    public function signin()
    {
        view('signin');
    }
}
