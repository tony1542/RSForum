<?php

use App\Utils\Database\Connection;
use App\Utils\EnvException;
use App\Utils\EnvValidator;
use App\Utils\Http\Server;
use Dotenv\Dotenv;

/**
 * Used to 'pretty-print' any array, object, or the like
 *
 * @param mixed $array
 * @param bool $verbose - A flag to specify whether we want a print_r or a more verbose var_dump
 */
function dump($array, $verbose = false): void
{
    $method = $verbose ? 'var_dump' : 'print_r';
    echo '<pre>';
    $method($array);
    echo '</pre>';
}

/**
 * Dump and die
 *
 * @param mixed $array
 * @param bool $verbose
 *
 * @see dump()
 */
function dd($array, $verbose = false): void
{
    dump($array, $verbose);
    die;
}

function jsonResponse($data, $jsonOption = 0): void
{
    header('Content-Type: application/json');
    echo json_encode($data, $jsonOption);
    die;
}

/**
 * Bootstraps our application with any setup required
 *
 * @throws EnvException
 */
function setApplicationVariables(): void
{
    session_start();

    // Set proper timezone for all date calls
    date_default_timezone_set('America/Chicago');

    // Ensure .env file exists
    $server = new Server();
    $filepath = $server->getRoot() . DIRECTORY_SEPARATOR;
    EnvValidator::fileExists($filepath . DIRECTORY_SEPARATOR . '.env');

    // Load .env file into the application
    $dotenv = Dotenv::createImmutable($filepath);
    $dotenv->load();

    // Check if our expected .env file has the expected values
    EnvValidator::enforce();

    // Checks if we have a dependency injection container set. If we don't, add a new one to the session
    setDependencyContainer(
        getDependencyContainer()
    );
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
