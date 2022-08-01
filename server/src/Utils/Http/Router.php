<?php

namespace App\Utils\Http;

use App\Controllers\AbstractBaseController;
use RuntimeException;

class Router
{
    /**
     * TODO only allow api responses; no blank page responses should ever happen in here
     *
     * Call the requested action's method with any parameters
     *
     * @return mixed
     *
     * @throws RuntimeException
     */
    public static function callAction()
    {
        $parameters = Request::getParameters();
        $controller = Request::getController();
        $action     = Request::getAction();
        $id         = Request::getID();
        $prefix     = Request::$default_controller_prefix;
        
        if ($controller !== Request::$default_controller) {
            $controller = $prefix . $controller;
        }
        
        // If there isn't a class that matches what was passed in
        if (!class_exists($controller)) {
            throw new RuntimeException(
                '"' . $controller . '" controller does not exist.'
            );
        }
        
        /** @var AbstractBaseController $controller */
        $controller = new $controller($id);
        
        // If there isn't a method that matches what was passed in for that controller
        if (!method_exists($controller, $action)) {
            throw new RuntimeException(
                '"' . get_class($controller) . '" does not have a "' . $action . '" function.'
            );
        }
    
        if (!$controller->canAccess($action, $parameters) && !getSignedInUser()->isAdmin()) {
            throw new RuntimeException(
                '"' . get_class($controller) . '"\'s "' . $action . '" function was denied access.'
            );
        }
        
        // Call the action requested and pass any parameters given
        return $controller->$action($parameters);
    }
}
