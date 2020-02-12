<?php

namespace App\Controllers;

/*
 * Base class that all controllers will extend
 * We do this so we can ensure all controllers follow similar setup / logic
 */
abstract class AbstractBaseController
{
    /**
     * Checking if the current user has permissions for the requested action
     * (Letting the controller that is created determine this)
     *
     * @param string $action
     * @param array  $parameters
     *
     * @return bool
     */
    abstract public function canAccess(string $action, array $parameters = []): bool;
    
    /**
     * Returns a simple string indicating where a particular controller's view will belong
     * For example, for User, the `getIncludePrefix` function would return 'user/';
     *
     * @return string
     */
    abstract protected function getIncludePrefix(): string;
}
