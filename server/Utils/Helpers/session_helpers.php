<?php

use App\Models\User\User;
use App\Utils\Http\Session;
use App\Utils\Container\DependencyInjectionContainer;
use Psr\Container\ContainerInterface;

/**
 * Returns our injection container from our session
 *
 * @return ContainerInterface
 */
function getDependencyContainer(): ContainerInterface
{
    return Session::get(DependencyInjectionContainer::class) ?: new DependencyInjectionContainer();
}

/**
 * Sets our injection container within our session
 *
 * @param ContainerInterface $container
 */
function setDependencyContainer(ContainerInterface $container): void
{
    Session::set(DependencyInjectionContainer::class, $container);
}

/**
 * Returns the current signed in user (object) from our session
 * If one doesn't exist, return an empty user object
 *
 * @return User
 */
function getSignedInUser(): User
{
    $signed_in_user = Session::get(User::class);

    if ($signed_in_user instanceof User) {
        return $signed_in_user;
    }
    
    return new User();
}

/**
 * Sets our signed in user (object) within our session
 *
 * @param User $user
 */
function setSignedInUser(User $user): void
{
    Session::set(User::class, $user);
}

