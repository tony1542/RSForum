<?php

use App\Models\User\User;
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

/**
 * @return User
 */
function getSignedInUser()
{
    return Session::get(User::class);
}

/**
 * @param User $user
 */
function setSignedInUser(User $user)
{
    Session::set(User::class, $user);
}
