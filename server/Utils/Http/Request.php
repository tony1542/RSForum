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
    
    protected static string $default_controller_action = 'index';
    
    public static string $default_controller = PagesController::class;
    public static string $default_controller_prefix = 'App\\Controllers\\';
    protected static string $default_controller_suffix = 'sController';
    
    /**
     * Fetch the request URI
     */
    public static function getUri(): string
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }
    
    public static function explodeUri(): array
    {
        return explode('/', self::getUri());
    }
    
    public static function getController(): string
    {
        $controller = self::explodeUri()[self::CONTROLLER_POSITION];
    
        // If no controller is passed, use our default
        if ($controller === '') {
            return self::$default_controller;
        }
        
        return urldecode($controller) . self::$default_controller_suffix;
    }
    
    public static function getAction(): string
    {
        $uri = self::explodeUri();
        
        if (!isset($uri[self::ACTION_POSITION])) {
            return self::$default_controller_action;
        }
        
        return urldecode(strtolower($uri[self::ACTION_POSITION]));
    }
    
    public static function getID(): string
    {
        return urldecode(self::explodeUri()[self::ID_POSITION] ?? 0);
    }

    public static function getInputStream(): array
    {
        return json_decode(file_get_contents("php://input"), true) ?? [];
    }

    public static function getParameters(): array
    {
        return self::getInputStream() ?? $_GET['parameters'] ?? $_POST['parameters'] ?? [];
    }
    
    public static function getPostValues(): array
    {
        return $_POST ?? [];
    }
    
    public static function getGetValues(): array
    {
        return $_GET ?? [];
    }
    
    /**
     * Dumps all relevant information in a request
     *
     * @param bool|int $verbose
     */
    public static function dump($verbose = 0): void
    {
        dump([
            'controller' => self::getController(),
            'action'     => self::getAction(),
            'id'         => self::getID(),
            'parameters' => self::getParameters(),
            'postArray'  => self::getPostValues(),
            'getArray'   => self::getGetValues(),
            'all'        => $_REQUEST,
            'uri'        => self::getUri()
        ], $verbose);
    }
}
