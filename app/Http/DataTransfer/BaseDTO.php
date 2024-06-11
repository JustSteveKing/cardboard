<?php

namespace App\Http\DataTransfer;

use ReflectionClass;
use ReflectionProperty;

class BaseDTO
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $array = [];

        foreach ($properties as $property) {
            $name = $property->getName();
            $array[$name] = $this->{$name};
        }

        return $array;
    }
}
