<?php

namespace EventSourced;

use DI\ContainerBuilder;

class DI {
    
    private static $container;
    
    public static function make($instance)
    {
        self::$container = self::$container ?: ContainerBuilder::buildDevContainer();
        return self::$container->get($instance);
    }
}