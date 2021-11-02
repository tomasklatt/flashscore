<?php

namespace app\validators\person;

class CityPropertyValidator implements PersonPropertyValidator
{
    public static function isValid(string $property): bool
    {
        return true;
    }
}