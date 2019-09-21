<?php

namespace App\Controllers;

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
