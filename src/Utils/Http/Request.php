<?php

namespace App\Utils\Http;

use App\Controllers\PagesController;

/*
 * Class handles the request aspect of our application
 * We can use it to grab $_POST or $_GET values and other helpful functions
 */
class Request
{
    // These constants will help the class tell which part of the URL belongs to the controller / action / ID
    protected const CONTROLLER_POSITION = 0;
    protected const ACTION_POSITION     = 1;
    protected const ID_POSITION         = 2;
    
    protected $default_controller_action = 'index';
    
    public $default_controller = PagesController::class;
    public $default_controller_prefix = "App\\Controllers\\";
    protected $default_controller_suffix = 'sController';
    
    /**
     * Fetch the request URI
     */
    public static function getUri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }
    
    public static function explodeUri()
    {
        return explode('/', self::getUri());
    }
    
    public function getController()
    {
        $controller = self::explodeUri()[self::CONTROLLER_POSITION];
    
        // If no controller is passed, use our default
        if ($controller === '') {
            return $this->default_controller;
        }
        
        return urldecode($controller) . $this->default_controller_suffix;
    }
    
    public function getAction()
    {
        $uri = self::explodeUri();
        
        if (!isset($uri[self::ACTION_POSITION])) {
            return $this->default_controller_action;
        }
        
        return urldecode(strtolower($uri[self::ACTION_POSITION]));
    }
    
    public function getID()
    {
        return urldecode(self::explodeUri()[self::ID_POSITION] ?? 0);
    }
    
    /**
     * Gets all parameters sent in the request
     *
     * @return array
     */
    public function getParameters()
    {
        return $_GET['parameters'] ?? $_POST['parameters'] ?? [];
    }
    
    public function getPostValues()
    {
        return $_POST ?? [];
    }
    
    public function getGetValues()
    {
        return $_GET ?? [];
    }
    
    /**
     * Dumps all relevant information in a request
     *
     * @param bool|int $verbose
     */
    public function dump($verbose = 0)
    {
        dump([
            'controller' => $this->getController(),
            'action'     => $this->getAction(),
            'id'         => $this->getID(),
            'parameters' => $this->getParameters(),
            'postArray'  => $this->getPostValues(),
            'getArray'   => $this->getGetValues(),
            'uri'        => self::getUri()
        ], $verbose);
    }
}