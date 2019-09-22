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
     * @return mixed
     */
    abstract public function canAccess($action, $parameters = []);
}
