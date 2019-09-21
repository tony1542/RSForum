<?php

namespace App\Controllers;

abstract class AbstractBaseController
{
    abstract protected function includePrefix();
    
    /**
     * Function's purpose is to get include path for using view()
     * @see view()
     */
    protected function getIncludePrefix()
    {
        return $this->includePrefix();
    }
    
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
