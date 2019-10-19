<?php

use App\Utils\Http\Session;
use App\Utils\Container\DependencyContainer;
use App\Utils\Container\NotFoundException;


use Psr\Container\ContainerInterface;

/**
 * Retrieves our injection container from our session
 *
 * @return ContainerInterface|DependencyContainer
 */
function getDependencyContainer()
{
    return Session::get(DependencyContainer::class);
}

/**
 * Sets our injection container within our session
 *
 * @param ContainerInterface $container
 */
function setDependencyContainer(ContainerInterface $container)
{
    Session::set(DependencyContainer::class, $container);
}
