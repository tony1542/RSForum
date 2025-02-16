<?php

namespace App\Utils\Container;

use Psr\Container\ContainerInterface;

class DependencyInjectionContainer implements ContainerInterface
{
    protected array $registry = [];

    public function get($id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Could not find requested resource (' . $id . ') in the container.');
        }

        return $this->registry[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->registry);
    }

    public function set(string $id, mixed $value): void
    {
        $this->registry[$id] = $value;
    }
}
