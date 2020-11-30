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
     * @param string $action     - The requested function within our controller
     * @param array  $parameters - Any additional parameters being sent in to be looked at
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
    
    /**
     * Call this to activate a particular view from a controller
     * This will bootstrap any other parameters necessary for the view
     *
     * @param string $view       - File path for the view
     * @param array  $parameters - Any additional parameters to be sent off to the view
     */
    abstract protected function toView(string $view, array $parameters = []): void;
}
