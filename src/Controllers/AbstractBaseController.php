<?php

namespace App\Controllers;

/*
 * Base class that all controllers will extend
 * We do this so we can ensure all controllers follow similar setup / logic
 */
abstract class AbstractBaseController
{
    protected $model;
    
    public function __construct(int $id = 0)
    {
        if ($id) {
            $model_class = $this->getModelClass();
            $this->model = new $model_class($id);
        }
    }
    
    /**
     * Declare a controller's model - used like "User::class", so it will dump a full namespaced class name
     *
     * @see https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class.class
     *
     * @return string
     */
    abstract protected function getModelClass(): string;
    
    /**
     * Specify the return type of the model - will hold whatever current object (if ID is present)
     *
     * @return mixed
     */
    abstract protected function getModel();
    
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
