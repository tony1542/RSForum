<?php

use App\Utils\Http\Session;
use App\Utils\Container\DependencyInjectionContainer;
use Psr\Container\ContainerInterface;

/**
 * Retrieves our injection container from our session
 *
 * @return ContainerInterface|DependencyInjectionContainer
 */
function getDependencyContainer()
{
    return Session::get(DependencyInjectionContainer::class);
}

/**
 * Sets our injection container within our session
 *
 * @param ContainerInterface $container
 */
function setDependencyContainer(ContainerInterface $container)
{
    Session::set(DependencyInjectionContainer::class, $container);
}
