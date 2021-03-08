<?php

namespace App\Utils\Http;

class JSONResponse
{
    private const TYPE_SUCCESS = 0;
    private const TYPE_ERROR   = 1;
    private const TYPE_WARNING = 2;
    
    private static function send($response, int $type): void
    {
        if (is_string($response)) {
            $response = [
                'response' => $response
            ];
        }
        
        $response['type'] = $type;
        
        header('Content-type: application/json');
        echo json_encode($response);
    }
    
    public static function success($response): void
    {
        self::send($response, self::TYPE_SUCCESS);
    }
    
    public static function error($response): void
    {
        self::send($response, self::TYPE_ERROR);
    }
    
    public static function warn($response): void
    {
        self::send($response, self::TYPE_WARNING);
    }
}
