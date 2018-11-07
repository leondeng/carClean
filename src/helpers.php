<?php

use CarClean\Container\SimpleContainer as Container;

if (! function_exists('app')) {
    function app($alias = null, array $arguments = [])
    {
        if (is_null($alias)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($alias, $arguments);
    }
}
