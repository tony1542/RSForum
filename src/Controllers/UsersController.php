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
    
    // TODO, insert a user in the DB when they register & redirect them home when it is done.
    // TODO (use the function 'redirect()' to do so, it's a helper function in helper.php
    // TODO also use 'password_hash' before inserting the password in the db
    // @see https://www.php.net/manual/en/function.password-hash.php
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
