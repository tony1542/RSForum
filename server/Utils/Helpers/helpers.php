<?php

use App\Utils\Database\EnvException;
use App\Utils\Database\EnvValidator;
use App\Utils\Http\Server;
use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;
use App\Utils\Container\DependencyInjectionContainer;
use App\Utils\Database\Connection;

/**
 * Used to 'pretty-print' any array, object, or the like
 *
 * @param mixed $array
 * @param bool  $verbose - A flag to specify whether we want a print_r or a more verbose var_dump
 */
function dump($array, $verbose = false): void
{
    $method = $verbose ? 'var_dump' : 'print_r';
    echo '<pre>'; $method($array); echo '</pre>';
}

/**
 * Dump and die
 *
 * @param mixed $array
 * @param bool  $verbose
 *
 * @see dump()
 */
function dd($array, $verbose = false): void
{
    dump($array, $verbose);
    die;
}

function jsonResponse($data): void
{
    echo json_encode($data);
}

/**
 * Bootstraps our application with any setup required
 *
 * @throws EnvException
 */
function setApplicationVariables(): void
{
    // Turn sessions on so we have access to the $_SESSION super-global
    session_start();
    
    // Set proper timezone for all date calls
    date_default_timezone_set('America/Chicago');
    
    if (Server::isLocalHost()) {
        $env_file_path = Server::getRoot() . DIRECTORY_SEPARATOR . 'config';
        EnvValidator::fileExists($env_file_path . DIRECTORY_SEPARATOR . '.env');
    } else {
        $env_file_path = Server::getRoot() . 'config';
        EnvValidator::fileExists($env_file_path . DIRECTORY_SEPARATOR . '.env');
    }
    
    // Load .env file into the application
    $dot_env = Dotenv::create($env_file_path);
    $dot_env->load();
    
    // Check if our expected .env file has the expected values
    EnvValidator::enforce('DB');
    
    // Checks if we have a dependency injection container set. If we don't, add a new one to the session
    $container = getDependencyContainer();
    
    if (!$container instanceof ContainerInterface) {
        $container = new DependencyInjectionContainer();
    }
    
    setDependencyContainer($container);
}

/**
 * Returns an instance of our database connection
 *
 * @return PDO
 */
function getDatabase(): PDO
{
    return Connection::getInstance();
}
