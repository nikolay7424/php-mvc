<?php

declare(strict_types=1);

namespace Framework;


use Closure;
use Exception;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionNamedType;

class Container
{
    private array $registry = [];

    public function set(string $name, Closure $value): void
    {
        $this->registry[$name] = $value;
    }

    public function get(string $class_name): object
    {
        if (array_key_exists($class_name, $this->registry)) {
            return $this->registry[$class_name]();
        }

        $reflector = new ReflectionClass($class_name);
        $constructor = $reflector->getConstructor();

        $dependencies = [];

        if ($constructor === null) {
            return new $class_name;
        }
        foreach ($constructor->getParameters() as $parameter) {
            $type = $parameter->getType();

            if ($type === null) {
                throw new InvalidArgumentException("constructor parameter '{$parameter->getName()}'
                    in the '{$class_name}' class has no type declaration");
            }

            if(!($type instanceof ReflectionNamedType)) {
                throw new InvalidArgumentException("constructor parameter '{$parameter->getName()}'
                    in the '{$class_name}' class is an invalid type: '{$type}'
                    - only single named types supported");
            }

            if ($type->isBuiltin()) {
                throw new InvalidArgumentException("unable to resolve constructor parameter '{$parameter->getName()}'
                    of a type '{$type}' in the '{$class_name}' class");
            }

            $dependencies[] = $this->get((string)$type);
        }

        return new $class_name(...$dependencies);
    }
}