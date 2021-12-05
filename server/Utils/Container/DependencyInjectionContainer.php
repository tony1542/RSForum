<?php

namespace App\Utils\Container;

use Psr\Container\ContainerInterface;

class DependencyInjectionContainer implements ContainerInterface
{
    protected array $registry = [];
    
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
            throw new NotFoundException('Could not find requested resource (' . $id . ') in the container.');
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
    public function has($id): bool
    {
        return array_key_exists($id, $this->registry);
    }
    
    /**
     * Set a new key/value into the container
     *
     * @param  string $id
     * @param  mixed  $value
     */
    public function set(string $id, $value): void
    {
        $this->registry[$id] = $value;
    }
}
