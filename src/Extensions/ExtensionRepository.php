<?php

namespace EventSourced\ValueObject\Extensions;

class ExtensionRepository
{
    private static $registry = [];

    public function __construct()
    {
        $this->registerExtensions();
    }

    private function loadExtensions()
    {
        return require __DIR__ . '/extensions.php';
    }

    private function registerExtensions()
    {
        foreach($this->loadExtensions() as $class => $serializer) {
            self::$registry[$class] = new $serializer();
        }
    }

    public function isExtension($unit)
    {
        $class = $this->getClass($unit);

        return isset(self::$registry[$class]);
    }

    public function fetch($criteria)
    {
        $class = $this->getClass($criteria);

        if (!isset(self::$registry[$class])) {
            throw new \Exception("No (de)serializer found for class ".$class);
        }

        return self::$registry[$class];
    }

    private function getClass($unit)
    {
        if (is_string($unit)) {
            return $unit;
        }

        if (is_object($unit)) {
            return get_class($unit);
        }

        throw new \Exception("Unable to retrieve class name");
    }
}
