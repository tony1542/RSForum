<?php

namespace App\Utils\Container;

use Psr\Container\ContainerInterface;

class DependencyInjectionContainer implements ContainerInterface
{
    /**
     * All registered key pairs.
     *
     * @var array
     */
    protected $registry = [];
    
    /**
     * Returns an item in the container if it exists
     *
     * @param string $id
     *
     * @return mixed
     *
     * @throws NotFoundException
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Could not find requested resource in the container.');
        }
        
        return $this->registry[$id];
    }
    
    /**
     * Checks if an item exists within our container
     *
     * @param string $id
     *
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, $this->registry);
    }
    
    /**
     * Set a new key/value into the container
     *
     * @param  string $id
     * @param  mixed  $value
     */
    public function set($id, $value)
    {
        $this->registry[$id] = $value;
    }
}