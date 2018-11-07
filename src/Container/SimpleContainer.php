<?php

namespace CarClean\Container;

class SimpleContainer
{
    protected static $instance;

    protected $instances;

    protected $aliases;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function make($alias, array $arguments = [])
    {
        if (isset($this->instances[$alias])) {
            return $this->instances[$alias];
        }

        $className = $this->getClassNameByAlias($alias);

        if (empty($arguments)) {
            $instance = new $className;
        } else {
            $reflection = new \ReflectionClass($className);
            $instance = $reflection->newInstanceArgs($arguments);
        }

        $this->instances[$alias] = $instance;

        return $instance;
    }

    public function register($alias, $className)
    {
        $this->aliases[$alias] = $className;
    }

    public function getClassNameByAlias($alias)
    {
        if (isset($this->aliases[$alias])) {
            return $this->aliases[$alias];
        }

        throw new \InvalidArgumentException("Alias {$alias} not registered!");
    }
}